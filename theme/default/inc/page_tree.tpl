<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="treeBox">
 <h3>{$lang.about_tree}</h3>
 <ul>
  <li<!-- {if $top_cur} --> class="cur"<!-- {/if} -->><a href="{$top.url}">{$top.page_name}</a></li>
  <!-- {foreach from=$page_list item=list} -->
  <li<!-- {if $list.cur} --> class="cur"<!-- {/if} -->><a href="{$list.url}">{$list.page_name}</a></li>
  <!-- {if $list.child} -->
  <ul>
   <!-- {foreach from=$list.child item=child} -->
   <li<!-- {if $child.cur} --> class="cur"<!-- {/if} -->>-<a href="{$child.url}">{$child.page_name}</a></li>
   <!-- {/foreach} -->
  </ul>
  <!-- {/if} -->
  <!--{/foreach}-->
 </ul>
</div>