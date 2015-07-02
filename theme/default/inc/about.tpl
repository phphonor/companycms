<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="incBox">
 <h3>{$index.about_name}</h3>
 <div class="about">
  <p><img src="../images/img_company.jpg" /></p>
  <dl>
   <dt>{$site.site_name}</dt>
   <dd>{$index.about_content|truncate:180:"..."}</dd>
  </dl>
  <div class="clear"></div>
  <a href="{$index.about_link}" class="aboutBtn">{$lang.about_link}{$index.about_name}</a>
 </div>
</div>