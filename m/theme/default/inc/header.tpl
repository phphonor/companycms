<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="header">
 <!-- {if $index.cur} -->
 <em class="logo"><!-- {if $site.mobile_logo} --><img src="../images/{$site.mobile_logo}"><!-- {else} -->{$site.mobile_name}<!-- {/if} --></em>
 <!-- {else} -->
 <a href="{$site.m_url}" class="home"></a>
 <!-- {/if} -->
 <!-- {if $is_product_list || $search_module eq 'product'} -->
 <div class="topSearch">{include file="inc/search_product.tpl"}</div>
 <!-- {elseif $is_article_list || $search_module eq 'article'} -->
 <div class="topSearch">{include file="inc/search_article.tpl"}</div>
 <!-- {else} -->
 <em>{$head}</em>
 <!-- {/if} -->
 <a href="{$site.catalog_link}" class="siteMap"></a>
</div>
