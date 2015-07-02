<?php /* Smarty version 2.6.26, created on 2015-07-02 14:18:02
         compiled from inc/pager.tpl */ ?>
<div class="pager"><?php echo $this->_tpl_vars['lang']['pager_1']; ?>
 <?php echo $this->_tpl_vars['pager']['record_count']; ?>
 <?php echo $this->_tpl_vars['lang']['pager_2']; ?>
，<?php echo $this->_tpl_vars['lang']['pager_3']; ?>
 <?php echo $this->_tpl_vars['pager']['page_count']; ?>
 <?php echo $this->_tpl_vars['lang']['pager_4']; ?>
，<?php echo $this->_tpl_vars['lang']['pager_5']; ?>
 <?php echo $this->_tpl_vars['pager']['page']; ?>
 <?php echo $this->_tpl_vars['lang']['pager_4']; ?>
 | <a href="<?php echo $this->_tpl_vars['pager']['first']; ?>
"><?php echo $this->_tpl_vars['lang']['pager_first']; ?>
</a> <?php if ($this->_tpl_vars['pager']['page'] > 1): ?><a href="<?php echo $this->_tpl_vars['pager']['previous']; ?>
"><?php echo $this->_tpl_vars['lang']['pager_previous']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['lang']['pager_previous']; ?>
<?php endif; ?> <?php if ($this->_tpl_vars['pager']['page'] < $this->_tpl_vars['pager']['page_count']): ?><a href="<?php echo $this->_tpl_vars['pager']['next']; ?>
"><?php echo $this->_tpl_vars['lang']['pager_next']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['lang']['pager_next']; ?>
<?php endif; ?> <a href="<?php echo $this->_tpl_vars['pager']['last']; ?>
"><?php echo $this->_tpl_vars['lang']['pager_last']; ?>
</a></div>