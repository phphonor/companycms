<?php /* Smarty version 2.6.26, created on 2015-07-02 14:17:57
         compiled from inc/recommend_product.tpl */ ?>
<?php if ($this->_tpl_vars['recommend_product']): ?>
<div class="incBox">
 <h3><a href="<?php echo $this->_tpl_vars['index']['product_link']; ?>
"><?php echo $this->_tpl_vars['lang']['product_news']; ?>
</a></h3>
 <ul class="recommendProduct">
  <?php $_from = $this->_tpl_vars['recommend_product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recommend_product'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recommend_product']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['recommend_product']['iteration']++;
?>
  <li<?php if ($this->_foreach['recommend_product']['iteration'] % 4 == 0): ?> class="clearBorder"<?php endif; ?>>
  <p class="img"><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
"><img src="<?php echo $this->_tpl_vars['product']['thumb']; ?>
" width="<?php echo $this->_tpl_vars['site']['thumb_width']; ?>
" height="<?php echo $this->_tpl_vars['site']['thumb_height']; ?>
" /></a></p>
  <p class="name"><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
"><?php echo $this->_tpl_vars['product']['name']; ?>
</a></p>
  <p class="price"><?php echo $this->_tpl_vars['product']['price']; ?>
</p>
  </li>
  <?php endforeach; endif; unset($_from); ?>
  <div class="clear"></div>
 </ul>
</div>
<?php endif; ?>