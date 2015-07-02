<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="searchBox">
 <form name="search" method="get" action="{$site.m_url}">
  <input name="s" type="text" class="keyword" autocomplete="off" maxlength="128" value="{if $keyword}{$keyword|escape}{else}{$lang.search}{/if}" onclick="formClick(this,'{$lang.search}')">
  <input type="submit" class="btnSearch" value="{$lang.btn_submit}">
 </form>
</div>