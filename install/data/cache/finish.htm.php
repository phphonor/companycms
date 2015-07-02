<?php /* Smarty version 2.6.26, created on 2015-07-02 14:17:29
         compiled from finish.htm */ ?>
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
 <div class="finish">
  <h3><?php echo $this->_tpl_vars['lang']['finish_title']; ?>
</h3>
  <p class="success"><?php echo $this->_tpl_vars['lang']['finish']; ?>
</p>
  <ul>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td width="120"><strong><?php echo $this->_tpl_vars['lang']['setting_username']; ?>
：</strong></td>
     <td>
      <?php echo $this->_tpl_vars['username']; ?>

     </td>
    </tr>
    <tr>
     <td><strong><?php echo $this->_tpl_vars['lang']['setting_password']; ?>
：</strong></td>
     <td>
      <?php echo $this->_tpl_vars['lang']['finish_password']; ?>

     </td>
    </tr>
   </table>
  </ul>
  <p class="action">
   <a href="../admin" class="btn"><?php echo $this->_tpl_vars['lang']['load']; ?>
</a>
  </p>
 </div>
</div>
</body>
</html>