<?php /* Smarty version 2.6.26, created on 2015-07-02 14:16:37
         compiled from setting.htm */ ?>
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
 <div class="setting">
  <?php if ($this->_tpl_vars['cue']): ?>
  <p class="cue"><strong><?php echo $this->_tpl_vars['lang']['wrong']; ?>
：</strong><?php echo $this->_tpl_vars['cue']; ?>
</p>
  <?php endif; ?>
  <form action="index.php?step=setting" method="POST">
   <ul>
    <h3><?php echo $this->_tpl_vars['lang']['setting_mysql']; ?>
</h3>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td width="120"><strong><?php echo $this->_tpl_vars['lang']['setting_host']; ?>
：</strong></td>
      <td width="225">
       <input type="text" name="dbhost" class="textInput" value="<?php if ($this->_tpl_vars['post']['dbhost']): ?><?php echo $this->_tpl_vars['post']['dbhost']; ?>
<?php else: ?>localhost<?php endif; ?>"/>
      </td>
      <td><?php echo $this->_tpl_vars['lang']['setting_host_cue']; ?>
</td>
     </tr>
     <tr>
      <td><strong><?php echo $this->_tpl_vars['lang']['setting_dbuser']; ?>
：</strong></td>
      <td>
       <input name="dbuser" type="text" class="textInput" value="<?php echo $this->_tpl_vars['post']['dbuser']; ?>
"/>
      </td>
      <td><?php echo $this->_tpl_vars['lang']['setting_dbuser_cue']; ?>
</td>
     </tr>
     <tr>
      <td><strong><?php echo $this->_tpl_vars['lang']['setting_dbpass']; ?>
：</strong></td>
      <td>
       <input type="password" name="dbpass" class="textInput"/>
      </td>
      <td><?php echo $this->_tpl_vars['lang']['setting_dbpass_cue']; ?>
</td>
     </tr>
     <tr>
      <td><strong><?php echo $this->_tpl_vars['lang']['setting_dbname']; ?>
：</strong></td>
      <td>
       <input name="dbname" type="text" class="textInput" value="<?php echo $this->_tpl_vars['post']['dbname']; ?>
"/>
      </td>
      <td><?php echo $this->_tpl_vars['lang']['setting_dbname_cue']; ?>
</td>
     </tr>
     <tr>
      <td><strong><?php echo $this->_tpl_vars['lang']['setting_prefix']; ?>
：</strong></td>
      <td>
       <input type="text" name="prefix" class="textInput" value="<?php if ($this->_tpl_vars['post']['prefix']): ?><?php echo $this->_tpl_vars['post']['prefix']; ?>
<?php else: ?>dou_<?php endif; ?>"/>
      </td>
      <td><?php echo $this->_tpl_vars['lang']['setting_prefix_cue']; ?>
</td>
     </tr>
    </table>
    <h3><?php echo $this->_tpl_vars['lang']['setting_manager']; ?>
</h3>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td width="120"><strong><?php echo $this->_tpl_vars['lang']['setting_username']; ?>
：</strong></td>
      <td width="225">
       <input name="username" type="text" class="textInput" value="<?php echo $this->_tpl_vars['post']['username']; ?>
"/>
      </td>
      <td><?php echo $this->_tpl_vars['lang']['setting_username_cue']; ?>
</td>
     </tr>
     <tr>
      <td><strong><?php echo $this->_tpl_vars['lang']['setting_password']; ?>
：</strong></td>
      <td>
       <input type="password" name="password" class="textInput"/>
      </td>
      <td><?php echo $this->_tpl_vars['lang']['setting_password_cue']; ?>
</td>
     </tr>
     <tr>
      <td><strong><?php echo $this->_tpl_vars['lang']['setting_password_confirm']; ?>
：</strong></td>
      <td>
       <input type="password" name="password_confirm" class="textInput"/>
      </td>
      <td><?php echo $this->_tpl_vars['lang']['setting_password_confirm_cue']; ?>
</td>
     </tr>
    </table>
   </ul>
   <p class="action">
    <input type="button" class="btnGray" value="<?php echo $this->_tpl_vars['lang']['back']; ?>
" onclick="location.href='index.php?step=check'"/>
    <input type="submit" class="btn" name="install" value="<?php echo $this->_tpl_vars['lang']['setting_submit']; ?>
">
   </p>
  </form>
 </div>
</div>
</body>
</html>