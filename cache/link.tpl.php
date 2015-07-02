<?php /* Smarty version 2.6.26, created on 2015-07-02 14:17:57
         compiled from inc/link.tpl */ ?>
<?php if ($this->_tpl_vars['link']): ?>
<div class="wrap">
 <div class="link"> <strong><?php echo $this->_tpl_vars['lang']['link']; ?>
：</strong>
  <?php $_from = $this->_tpl_vars['link']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['link'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['link']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['link']):
        $this->_foreach['link']['iteration']++;
?>
  <a href="<?php echo $this->_tpl_vars['link']['link_url']; ?>
" target="_blank" ><?php echo $this->_tpl_vars['link']['link_name']; ?>
</a>
  <?php endforeach; endif; unset($_from); ?>
 </div>
</div>
<?php endif; ?>