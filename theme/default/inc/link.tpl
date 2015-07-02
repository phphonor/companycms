<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- {if $link} -->
<div class="wrap">
 <div class="link"> <strong>{$lang.link}：</strong>
  <!-- {foreach from=$link name=link item=link} -->
  <a href="{$link.link_url}" target="_blank" >{$link.link_name}</a>
  <!-- {/foreach} -->
 </div>
</div>
<!-- {/if} -->