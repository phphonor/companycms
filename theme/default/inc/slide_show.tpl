<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="slideShow">
 <ul class="slides">
  <!-- {foreach from=$show_list name=show item=show} -->
  <li><a href="{$show.show_link}" target="_blank" style="background-image:url({$show.show_img})"></a></li>
  <!-- {/foreach} -->
 </ul>
</div>
<script type="text/javascript">
{literal}
$(document).ready(function(){
	$('.slides').bxSlider({
			mode: 'fade'
	});
})
{/literal}
</script>