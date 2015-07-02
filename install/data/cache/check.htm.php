<?php /* Smarty version 2.6.26, created on 2015-07-02 14:16:34
         compiled from check.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<link href="template/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
 <div class="logo"><a href="http://www.douco.com" target="_blank"><img src="template/logo.gif" alt="DouPHP" title="DouPHP" /></a></div>
 <div class="check">
  <h3><?php echo $this->_tpl_vars['lang']['check_system']; ?>
</h3>
  <ul>
   <li><?php echo $this->_tpl_vars['lang']['os']; ?>
..................................................................<?php echo $this->_tpl_vars['sys_info']['os']; ?>
</li>
   <li><?php echo $this->_tpl_vars['lang']['web_server']; ?>
......................................................<?php echo $this->_tpl_vars['sys_info']['web_server']; ?>
</li>
   <li><?php echo $this->_tpl_vars['lang']['php_version']; ?>
..................................................................<?php echo $this->_tpl_vars['sys_info']['php_ver']; ?>
</li>
   <li><?php echo $this->_tpl_vars['lang']['mysql_version']; ?>
..................................................................<?php echo $this->_tpl_vars['sys_info']['mysql_ver']; ?>
</li>
   <li><?php echo $this->_tpl_vars['lang']['socket']; ?>
..................................................................<?php echo $this->_tpl_vars['sys_info']['socket']; ?>
</li>
   <li><?php echo $this->_tpl_vars['lang']['timezone']; ?>
..................................................................<?php echo $this->_tpl_vars['sys_info']['timezone']; ?>
</li>
   <li><?php echo $this->_tpl_vars['lang']['gd_version']; ?>
..................................................................<?php echo $this->_tpl_vars['sys_info']['gd']; ?>
</li>
   <li><?php echo $this->_tpl_vars['lang']['zlib']; ?>
..................................................................<?php echo $this->_tpl_vars['sys_info']['zlib']; ?>
</li>
  </ul>
  <h3><?php echo $this->_tpl_vars['lang']['check_dir']; ?>
</h3>
  <ul>
   <?php $_from = $this->_tpl_vars['writeable']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['writeable']):
?>
   <li><?php echo $this->_tpl_vars['writeable']['dir']; ?>
..................................................................<?php echo $this->_tpl_vars['writeable']['if_write']; ?>
</li>
   <?php endforeach; endif; unset($_from); ?>
  </ul>
  <p class="action">
  <input type="button" class="btnGray" value="<?php echo $this->_tpl_vars['lang']['back']; ?>
" onclick="location.href='index.php?step=welcome'"/>
  <?php if ($this->_tpl_vars['no_write']): ?>
  <input type="submit" class="btnGray" value="<?php echo $this->_tpl_vars['lang']['next']; ?>
" onclick="location.href='index.php?step=setting'" disabled="true"/>
  <?php else: ?>
  <input type="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['next']; ?>
" onclick="location.href='index.php?step=setting'"/>
  <?php endif; ?>
  </p>
 </div>
</div>
</body>
</html>