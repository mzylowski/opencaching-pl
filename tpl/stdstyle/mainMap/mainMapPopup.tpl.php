<?php //This is handlebars-js template - see https://handlebarsjs.com/ for format details ?>

<div class="col">

    <div class="row">

      <div class="row">
        <a href="/viewcache.php?wp={{cacheCode}}&print_list=y" rel="noopener" target="_blank">
          <img src="/images/actions/list-add-16.png" title="<?=tr("add_to_list")?>"
               alt="<?=tr("add_to_list")?>">
        </a>

        <img id="cacheIcon" src="{{cacheIcon}}" alt="cache-icon">

        <a title="{{cacheName}}" href="{{cacheUrl}}" rel="noopener" target="_blank" class="col">
          <div>{{cacheCode}}</div>
          <div id="cacheName">{{cacheName}}</div>
        </a>
      </div>

      <div id="mapPopup-closer">✖</div>
    </div>

    <div class="row">
      <div class="col">
      {{#unless isEvent}}
        <div>
          <b><?=tr("size")?>:</b> {{cacheSizeDesc}}
        </div>
      {{/unless}}

      {{#if ratingDesc}}
        <div>
          <b><?=tr("score")?>:</b> {{ratingDesc}}
        </div>
      {{/if}}

        <div>
          <b><?=tr("owner")?>:</b>
          <a href="{{ownerProfileUrl}}" rel="noopener" target="_blank">{{ownerName}}</a>
        </div>

      {{#if isEvent}}
        <div>
          <b><?=tr("beginning")?>:</b> {{eventStartDate}}
        </div>
      {{/if}}
      </div>

      <div class="col">
        <div>
        {{#if isEvent}}
          <img src="/tpl/stdstyle/images/log/16x16-attend.png" alt="<?=tr("attendends")?>">
          {{cacheFounds}} x <?=tr("attendends")?>
        {{else}}
          <img src="/tpl/stdstyle/images/log/16x16-found.png" alt="<?=tr("found")?>">
          {{cacheFounds}} x <?=tr("found")?>
        {{/if}}
        </div>

        <div>
        {{#if isEvent}}
          <img src="/tpl/stdstyle/images/log/16x16-will_attend.png" alt="<?=tr("will_attend")?>">
          {{cacheNotFounds}} x <?=tr("will_attend")?>
        {{else}}
          <img src="/tpl/stdstyle/images/log/16x16-dnf.png" alt="<?=tr("not_found")?>">
          {{cacheNotFounds}} x <?=tr("not_found")?>
        {{/if}}
        </div>

        <div>
          <img src="/tpl/stdstyle/images/free_icons/thumb_up.png" alt="<?=tr("scored")?>">
            {{cacheRatingVotes}} x <?=tr("scored")?>
          </div>

      {{#if cacheRecosNumber}}
        <div>
          <img src="/images/rating-star.png" alt="<?=tr("recommended")?>">
          {{cacheRecosNumber}} x <?=tr("recommended")?>
        </div>
      {{/if}}

      {{#if titledDesc}}
        <div>
          <img src="/tpl/stdstyle/images/free_icons/award_star_gold_1.png" alt="{{titledDesc}}">
          {{titledDesc}}
        </div>
      {{/if}}
      </div>
    </div>

    {{#if powerTrailName}}
    <div>
      <div>
        <b><?=tr("pt000")?>:</b>
        <a href="{{powerTrailUrl}}" title="{{powerTrailName}}" rel="noopener" target="_blank">
        <img src="{{powerTrailIcon}}" alt="<?=tr("pt000")?>" title="{{powerTrailName}}">
        {{powerTrailName}}</a>
      </div>
    </div>
    {{/if}}

</div>
