<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="treeBox">
 <h3>{$lang.article_tree}</h3>
 <ul>
  <!-- {foreach from=$article_category item=cate} 一级分类 -->
  <li<!-- {if $cate.cur} --> class="cur"<!-- {/if} -->><a href="{$cate.url}">{$cate.cat_name}</a></li>
  <!-- {if $cate.child} -->
  <ul>
   <!-- {foreach from=$cate.child item=child} 二级分类 -->
   <li<!-- {if $child.cur} --> class="cur"<!-- {/if} -->>-<a href="{$child.url}">{$child.cat_name}</a></li>
   <!-- {/foreach} -->
  </ul>
  <!-- {/if} -->
  <!--{/foreach}-->
 </ul>
 <ul class="searchBox">
  <form name="search" id="search" method="get" action="{$site.root_url}">
   <input type="hidden" name="module" value="article">
   <label for="keyword">{$lang.search_cue}</label>
   <input name="s" type="text" class="keyword" title="{$lang.search_cue}" autocomplete="off" maxlength="128" value="{if $keyword}{$keyword|escape}{else}{$lang.search_article}{/if}" onclick="formClick(this,'{$lang.search_article}')">
   <input type="submit" class="btnSearch" value="{$lang.btn_submit}">
  </form>
 </ul>
</div>