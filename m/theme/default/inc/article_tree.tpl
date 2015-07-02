<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="treeBox">
 <!-- {foreach from=$article_category item=cate} 一级分类 -->
 <a href="{$cate.url}"<!-- {if $cate.cur} --> class="cur"<!-- {/if} -->>{$cate.cat_name}</a>
 <!--{/foreach}-->
</div>