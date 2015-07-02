<?php /* Smarty version 2.6.26, created on 2015-07-02 14:17:57
         compiled from inc/about.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'inc/about.tpl', 7, false),)), $this); ?>
<div class="incBox">
 <h3><?php echo $this->_tpl_vars['index']['about_name']; ?>
</h3>
 <div class="about">
  <p><img src="http://localhost/webcms/companycms/theme/default/images/img_company.jpg" /></p>
  <dl>
   <dt><?php echo $this->_tpl_vars['site']['site_name']; ?>
</dt>
   <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['index']['about_content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 180, "...") : smarty_modifier_truncate($_tmp, 180, "...")); ?>
</dd>
  </dl>
  <div class="clear"></div>
  <a href="<?php echo $this->_tpl_vars['index']['about_link']; ?>
" class="aboutBtn"><?php echo $this->_tpl_vars['lang']['about_link']; ?>
<?php echo $this->_tpl_vars['index']['about_name']; ?>
</a>
 </div>
</div>