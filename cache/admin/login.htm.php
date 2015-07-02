<?php /* Smarty version 2.6.26, created on 2015-07-02 14:17:31
         compiled from login.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_tpl_vars['lang']['login']; ?>
</title>
<meta name="Copyright" content="Douco Design." />
<link href="templates/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="images/global.js"></script>
</head>
<body>
<form action="login.php?rec=login" method="post">
<div id="login">
  <div class="dologo"></div>
  <ul>  
   <li class="inpLi"><b><?php echo $this->_tpl_vars['lang']['login_user_name']; ?>
：</b><input type="text" name="user_name" class="inpLogin"></li>
   <li class="inpLi"><b><?php echo $this->_tpl_vars['lang']['login_password']; ?>
：</b><input type="password" name="password" class="inpLogin"></li>
   <?php if ($this->_tpl_vars['site']['captcha']): ?>
   <li class="vcodePic">
     <div class="inpLi"><b><?php echo $this->_tpl_vars['lang']['login_vcode']; ?>
：</b><input type="text" name="vcode" class="vcode"></div>
     <img id="captcha" src="../captcha.php" alt="<?php echo $this->_tpl_vars['lang']['captcha']; ?>
" border="1" onClick="refreshimage()" title="<?php echo $this->_tpl_vars['lang']['login_vcode_refresh']; ?>
">
   </li>
   <?php endif; ?>
   <li><input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['login_submit']; ?>
"></li> 
  </ul>
</div>
</form>
</body>
</html>