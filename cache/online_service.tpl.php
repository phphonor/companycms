<?php /* Smarty version 2.6.26, created on 2015-07-02 14:17:57
         compiled from inc/online_service.tpl */ ?>
<?php if ($this->_tpl_vars['site']['qq']): ?>
<div id="onlineService">
 <div class="onlineIcon"><?php echo $this->_tpl_vars['lang']['online']; ?>
</div>
 <div id="pop">
  <ul class="onlineQQ">
  <?php $_from = $this->_tpl_vars['site']['qq']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['qq']):
?>
  <?php if (is_array ( $this->_tpl_vars['qq'] )): ?>
  <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_tpl_vars['qq']['number']; ?>
&site=qq&menu=yes" target="_blank"><?php echo $this->_tpl_vars['qq']['nickname']; ?>
</a>
  <?php else: ?>
  <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_tpl_vars['qq']; ?>
&site=qq&menu=yes" target="_blank"><?php echo $this->_tpl_vars['lang']['online_qq']; ?>
</a>
  <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
  </ul>
  <ul class="service">
   <li><?php echo $this->_tpl_vars['lang']['contact_tel']; ?>
<br /><?php echo $this->_tpl_vars['site']['tel']; ?>
</li>
   <li><a href="<?php echo $this->_tpl_vars['site']['guestbook_link']; ?>
"><?php echo $this->_tpl_vars['lang']['guestbook_add']; ?>
</a></li>
  </ul>
 </div>
 <p class="goTop"><a href="javascript:;" onfocus="this.blur();" class="goBtn"></a></p>
</div>
<?php endif; ?>