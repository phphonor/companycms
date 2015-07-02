<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="treeBox">
 <a href="{$top.url}"<!-- {if $top_cur} --> class="cur"<!-- {/if} -->>{$top.page_name}</a></li>
 <!-- {foreach from=$page_list item=list} -->
 <a href="{$list.url}"<!-- {if $list.cur} --> class="cur"<!-- {/if} -->>{$list.page_name}</a>
 <!--{/foreach}-->
</div>