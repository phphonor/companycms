<?php /* Smarty version 2.6.26, created on 2015-07-02 14:18:02
         compiled from inc/product_tree.tpl */ ?>
<div class="treeBox">
 <h3><?php echo $this->_tpl_vars['lang']['product_tree']; ?>
</h3>
 <ul>
  <?php $_from = $this->_tpl_vars['product_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cate']):
?>
  <li<?php if ($this->_tpl_vars['cate']['cur']): ?> class="cur"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['cate']['url']; ?>
"><?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</a></li>
  <?php if ($this->_tpl_vars['cate']['child']): ?>
  <ul>
   <?php $_from = $this->_tpl_vars['cate']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>
   <li<?php if ($this->_tpl_vars['child']['cur']): ?> class="cur"<?php endif; ?>>-<a href="<?php echo $this->_tpl_vars['child']['url']; ?>
"><?php echo $this->_tpl_vars['child']['cat_name']; ?>
</a></li>
   <?php endforeach; endif; unset($_from); ?>
  </ul>
  <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
 </ul>
</div>