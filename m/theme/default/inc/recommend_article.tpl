<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- {if $recommend_article} -->
<div class="incBox">
 <h3><a href="{$index.article_link}" class="more">{$lang.article_more} ></a>{$lang.article_news}</h3>
 <div class="articleList">
  <!-- {foreach from=$recommend_article name=recommend_article item=article} -->
  <dl>
   <dt><a href="{$article.url}">{$article.title}</a></dt>
   <dd><em>{$lang.add_time}：{$article.add_time}</em><em>{$lang.click}：{$article.click}</em></dd>
  </dl>
  <!-- {/foreach} -->
 </div>
</div>
<!-- {/if} -->