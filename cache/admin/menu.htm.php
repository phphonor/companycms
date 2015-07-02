<?php /* Smarty version 2.6.26, created on 2015-07-02 14:17:51
         compiled from menu.htm */ ?>
<!-- 后台菜单 -->
<div id="menu">
 <ul class="top">
  <li><a href="index.php"><i class="home"></i><em><?php echo $this->_tpl_vars['lang']['menu_home']; ?>
</em></a></li>
 </ul>
 <ul>
  <li<?php if ($this->_tpl_vars['cur'] == 'system'): ?> class="cur"<?php endif; ?>><a href="system.php"><i class="system"></i><em><?php echo $this->_tpl_vars['lang']['system']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'nav'): ?> class="cur"<?php endif; ?>><a href="nav.php"><i class="nav"></i><em><?php echo $this->_tpl_vars['lang']['nav']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'show'): ?> class="cur"<?php endif; ?>><a href="show.php"><i class="show"></i><em><?php echo $this->_tpl_vars['lang']['show']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'page'): ?> class="cur"<?php endif; ?>><a href="page.php"><i class="page"></i><em><?php echo $this->_tpl_vars['lang']['menu_page']; ?>
</em></a></li>
 </ul>
 <ul>
  <li<?php if ($this->_tpl_vars['cur'] == 'product_category'): ?> class="cur"<?php endif; ?>><a href="product_category.php"><i class="productCat"></i><em><?php echo $this->_tpl_vars['lang']['product_category']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'product'): ?> class="cur"<?php endif; ?>><a href="product.php"><i class="product"></i><em><?php echo $this->_tpl_vars['lang']['product']; ?>
</em></a></li>
 </ul>
 <ul>
  <li<?php if ($this->_tpl_vars['cur'] == 'article_category'): ?> class="cur"<?php endif; ?>><a href="article_category.php"><i class="articleCat"></i><em><?php echo $this->_tpl_vars['lang']['article_category']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'article'): ?> class="cur"<?php endif; ?>><a href="article.php"><i class="article"></i><em><?php echo $this->_tpl_vars['lang']['article']; ?>
</em></a></li>
 </ul>
 <ul>
  <li<?php if ($this->_tpl_vars['cur'] == 'manager'): ?> class="cur"<?php endif; ?>><a href="manager.php"><i class="manager"></i><em><?php echo $this->_tpl_vars['lang']['manager']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'manager_log'): ?> class="cur"<?php endif; ?>><a href="manager.php?rec=manager_log"><i class="managerLog"></i><em><?php echo $this->_tpl_vars['lang']['manager_log']; ?>
</em></a></li>
 </ul>
 <ul class="bot">
  <li<?php if ($this->_tpl_vars['cur'] == 'mobile'): ?> class="cur"<?php endif; ?>><a href="mobile.php"><i class="mobile"></i><em><?php echo $this->_tpl_vars['lang']['mobile_system']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'guestbook'): ?> class="cur"<?php endif; ?>><a href="guestbook.php"><i class="guestbook"></i><em><?php echo $this->_tpl_vars['lang']['guestbook']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'backup'): ?> class="cur"<?php endif; ?>><a href="backup.php"><i class="backup"></i><em><?php echo $this->_tpl_vars['lang']['backup']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'link'): ?> class="cur"<?php endif; ?>><a href="link.php"><i class="link"></i><em><?php echo $this->_tpl_vars['lang']['link']; ?>
</em></a></li>
 </ul>
</div>