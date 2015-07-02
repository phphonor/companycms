<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="searchBox">
 <form name="search" method="get" action="{$site.m_url}">
  <input type="hidden" name="module" value="article">
  <input name="s" type="text" class="keyword" autocomplete="off" maxlength="128" value="{if $keyword_article}{$keyword_article|escape}{else}{$lang.search_article}{/if}" onclick="formClick(this,'{$lang.search_article}')">
  <input type="submit" class="btnSearch" value="{$lang.btn_submit}">
 </form>
</div>