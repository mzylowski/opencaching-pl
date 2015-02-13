<?php

namespace lib\Objects\Medals;

use \lib\Database\DataBaseSingleton;
use \lib\Objects\User\User;

/**
 * medal to be awarded when use complete specified geopath
 *
 * @author Łza
 */
class MedalMaxAltitude extends Medal implements MedalInterface
{

    protected $conditions;

    public function checkConditionsForUser(User $user)
    {
		if (!in_array($this->config->getOcNodeId(), $this->conditions['ocNodeId'])) { /* this medal is not available in current node */
            return;
        }

        /* @var $db \dataBase */
        $db = DataBaseSingleton::Instance();
		$queryFound = 'SELECT MAX(`altitude`) as maxAltitude FROM `caches`, `caches_additions`, cache_logs
			WHERE caches.`cache_id` = caches_additions.`cache_id` AND cache_logs.cache_id = caches.`cache_id`
			AND cache_logs.type = 1 AND cache_logs.user_id = :1 AND caches.type IN(:2)';
		$cacheTypes = $this->buildCacheTypesSqlString();
        $db->multiVariableQuery($queryFound, $user->getUserId(), $cacheTypes);
        $foundMaxAltitudeRaw = $db->dbResultFetchOneRowOnly();
		$foundMaxAltitude = (int) $foundMaxAltitudeRaw['maxAltitude'];
		$queryPlaced = 'SELECT MAX(`altitude`) as maxAltitude FROM `caches`, `caches_additions`
			WHERE caches.`cache_id` = caches_additions.`cache_id`
			AND cache.user_id = :1 AND caches.type IN(:2) AND cache.status = :3';
		$db->multiVariableQuery($queryPlaced, $user->getUserId(), $cacheTypes, \cache::STATUS_READY);
        $placedMaxAltitudeRaw = $db->dbResultFetchOneRowOnly();
		$placedMaxAltitude = (int) $placedMaxAltitudeRaw['maxAltitude'];
		$this->findLevel($foundMaxAltitude, $placedMaxAltitude);
        $this->storeMedalStatus($user);
    }

	public function getLevelInfo($level = null)
	{}

	private function findLevel($foundMaxAltitude, $placedMaxAltitude){
		$this->prizedTime = false;
		foreach($this->conditions['altitudeToAward'] as $levelId => $level) {
			if ($foundMaxAltitude >= $level['altitude']['found'] && $placedMaxAltitude >= $level['altitude']['placed']) {
				$this->level = $levelId;
				$this->prizedTime = date($this->config->getDbDateTimeFormat());
			}
		}
	}

}
