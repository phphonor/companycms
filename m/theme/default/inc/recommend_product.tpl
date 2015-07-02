<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- {if $recommend_product} -->
<div class="incBox">
 <h3><a href="{$index.product_link}" class="more">{$lang.product_more} ></a>{$lang.product_news}</h3>
 <div class="productList"> 
  <!-- {foreach from=$recommend_product name=recommend_product item=product} -->
  <dl>
   <dd<!-- {if $smarty.foreach.recommend_product.iteration % 2 eq 0} --> class="clearBorder"<!-- {/if} -->>
   <p class="img"><a href="{$product.url}"><img src="{$product.thumb}" width="{$site.thumb_width}" height="{$site.thumb_height}" /></a></p>
   <p class="name"><a href="{$product.url}">{$product.name|truncate:10:"."}</a></p>
   <p class="price">{$product.price}</p>
   </dd>
  </dl>
  <!-- {/foreach} --> 
 </div >
</div>
<!-- {/if} -->