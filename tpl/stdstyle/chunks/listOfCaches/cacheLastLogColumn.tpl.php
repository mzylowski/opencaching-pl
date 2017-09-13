<?php

use lib\Objects\GeoCache\GeoCacheLogCommons;
use lib\Objects\User\UserCommons;
use Utils\DateTime\OcDate;

/**
	This is column with log-icon and log-text.
  It needs vars in $data:
		- logId - id of the log
    - logType - type of the log
    - logText - text of the log
    - logUserId - id of the loff author
    - logUserName - name of the author
    - logDate - date of the log
*/


return function (array $data){

    if( !isset($data['logId']) || is_null($data['logId']) ){
        // there is no log data - exit;
        $nolog = true;
    }else{
        $nolog = false;
        $logIcon = GeoCacheLogCommons::GetIconForType($data['logType']);
        $userProfileUrl = UserCommons::GetUserProfileUrl($data['logUserId']);
        $userName = $data['logUserName'];
        $logText = GeoCacheLogCommons::cleanLogTextForToolTip($data['logText']);
        $logDate = OcDate::getFormattedDate($data['logDate']);
        $logTypeName = GeoCacheLogCommons::cleanLogTextForToolTip(
            tr(GeoCacheLogCommons::typeTranslationKey($data['logType'])));
    }

?>
  <?php if(!$nolog) { ?>

      <a href="<?=$userProfileUrl?>"
         onmouseover="Tip('<b><?=$userName?> (<?=$logTypeName?>):</b><br/><?=$logText?>',
           PADDING,5,WIDTH,280,SHADOW,true)"
         onmouseout="UnTip()" >

        <img src="<?=$logIcon?>" class="icon16" alt="LogIcon" title="LogIcon" />
        <?=$logDate?>
      </a>

  <?php } else { // $nolog ?>
      <?=tr('usrWatch_noLogs')?>
  <?php } ?>
<?php
};

