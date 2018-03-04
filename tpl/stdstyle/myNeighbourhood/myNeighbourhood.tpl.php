<?php
use Utils\Uri\SimpleRouter;
use lib\Objects\Neighbourhood\Neighbourhood;

?>
<div class="content2-container">
  <?php foreach ($view->neighbourhoodsList as $nbh) {
      if ($nbh->getSeq() == $view->selectedNbh) {
          $btnClassMod = 'btn-primary';
      } else {
          $btnClassMod = 'btn-default';
      }
      ?>
    <a class="btn btn-md <?=$btnClassMod?>" href="<?=SimpleRouter::getLink('MyNeighbourhood', 'index', $nbh->getSeq())?>"><?=$nbh->getName()?></a>
  <?php } // end foreach neighbourhoodsList ?>
  <a class="btn btn-md btn-success" href="<?=SimpleRouter::getLink('MyNeighbourhood', 'config', $view->selectedNbh)?>"><img src="/tpl/stdstyle/images/free_icons/cog.png" class="icon16" alt="<?=tr('config')?>">&nbsp;<?=tr('config')?></a>

  <div class="nbh-sort-list">
  <?php
    $order = [];
    foreach ($view->preferences['items'] as $key => $item) {
        $order[$item['order']] = $item;
        $order[$item['order']]['item'] = $key;
    }
    ksort($order);
    foreach ($order as $item) {
      $classSize = ($item['fullsize'] == 1) ? 'nbh-full' : 'nbh-half';
      switch ($item['item']) {
          case Neighbourhood::ITEM_MAP:
              $subTemplate = '/myNeighbourhood/sub_Map';
              break;
          case Neighbourhood::ITEM_LATESTCACHES:
              $subTemplate = '/myNeighbourhood/sub_LatestCaches';
              break;
          case Neighbourhood::ITEM_UPCOMINGEVENTS:
              $subTemplate = '/myNeighbourhood/sub_UpcommingEvents';
              break;
          case Neighbourhood::ITEM_FTFCACHES:
              $subTemplate = '/myNeighbourhood/sub_FTFCaches';
              break;
          case Neighbourhood::ITEM_LATESTLOGS:
              $subTemplate = '/myNeighbourhood/sub_LatestLogs';
              break;
          case Neighbourhood::ITEM_TITLEDCACHES:
              $subTemplate = '/myNeighbourhood/sub_TitledCaches';
              break;
          case Neighbourhood::ITEM_RECOMMENDEDCACHES:
              $subTemplate = '/myNeighbourhood/sub_RecommendedCaches';
              break;
          default:
              break;
      }
      ?>
      <div class="nbh-block <?=$classSize?>" id="item_<?=$item['item']?>">
          <?=$view->callSubTpl($subTemplate)?>
      </div>
  <?php } ?>
  </div>
  <div class="buffer"></div>
  <div class="notice"><?=tr('myn_dragdrop')?></div>
  <div class="notice"><?=tr('myn_distances')?></div>
</div>
<script>
let changeOrderUri = "<?=SimpleRouter::getLink('MyNeighbourhood', 'changeOrderAjax')?>"
let changeSizeAjaxUri = "<?=SimpleRouter::getLink('MyNeighbourhood', 'changeSizeAjax')?>"
let changeDisplayAjaxUri = "<?=SimpleRouter::getLink('MyNeighbourhood', 'changeDisplayAjax')?>"
</script>