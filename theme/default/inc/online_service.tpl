<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- {if $site.qq} -->
<div id="onlineService">
 <div class="onlineIcon">{$lang.online}</div>
 <div id="pop">
  <ul class="onlineQQ">
  <!-- {foreach from=$site.qq item=qq} -->
  <!-- {if is_array($qq)} -->
  <a href="http://wpa.qq.com/msgrd?v=3&uin={$qq.number}&site=qq&menu=yes" target="_blank">{$qq.nickname}</a>
  <!-- {else} -->
  <a href="http://wpa.qq.com/msgrd?v=3&uin={$qq}&site=qq&menu=yes" target="_blank">{$lang.online_qq}</a>
  <!-- {/if} -->
  <!-- {/foreach} -->
  </ul>
  <ul class="service">
   <li>{$lang.contact_tel}<br />{$site.tel}</li>
   <li><a href="{$site.guestbook_link}">{$lang.guestbook_add}</a></li>
  </ul>
 </div>
 <p class="goTop"><a href="javascript:;" onfocus="this.blur();" class="goBtn"></a></p>
</div>
<!-- {/if} -->