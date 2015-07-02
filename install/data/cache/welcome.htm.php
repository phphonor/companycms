<?php /* Smarty version 2.6.26, created on 2015-07-02 14:16:20
         compiled from welcome.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<link href="template/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
<?php echo '
function agree()
{
  if (document.getElementById(\'btn_license\').checked)
	{
    document.getElementById(\'submit\').disabled=false;
    document.getElementById(\'submit\').className=\'btn\';  
	}
  else
	{
    document.getElementById(\'submit\').disabled=\'disabled\';  
    document.getElementById(\'submit\').className=\'btnGray\';  
	}
}
'; ?>

</script>
</head>
<body>
<div id="wrapper">
 <div class="logo"><a href="http://www.douco.com" target="_blank"><img src="template/logo.gif" alt="DouPHP" title="DouPHP" /></a></div>
 <div class="license">
  <form action="" method="post">
   <ul>
    <textarea name="request" cols="90" rows="15" readonly="readonly">© 2014-2015 漳州豆壳网络科技有限公司。保留所有权利。

感谢您选择DouPHP企业网站管理系统（以下简称DouPHP），DouPHP提供一个轻量级企业网站解决方案，基于 PHP + MySQL 的技术开发，全部源码开放。

为了使您正确并合法的使用本软件，请您在使用前务必阅读清楚下面的协议条款： 
一、本授权协议适用且仅适用于 DouPHP 1.x.x 版本，DouCo官方对本授权协议拥有最终解释权。

二、协议许可的权利
1.您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于商业用途，而不必支付软件版权授权费用。
2.您可以在协议规定的约束和限制范围内修改 DouPHP 源代码或界面风格以适应您的网站要求。
3.您拥有使用本软件构建的网站全部内容所有权，并独立承担与这些内容的相关法律义务。
4.获得商业授权之后，您可以去除DouPHP的版权信息，同时依据所购买的授权类型中确定的技术支持内容，自购买时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。

三、协议规定的约束和限制
1.未获商业授权之前，不得删除网站底部及相应的官方版权信息和链接。DouPHP著作权已在中华人民共和国国家版权局注册(中国国家版权局著作权登记号 2013SR122168)，著作权受到法律和国际公约保护 。购买商业授权请登陆www.douco.com了解最新说明。
2.未经官方许可，不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。
3.不管您的网站是否整体使用 DouPHP ，还是部份栏目使用 DouPHP，在您网站页面页脚处的 Powered by DouPHP 名称和 http://www.douco.com 的链接都必须保留且不能修改。
4.未经官方许可，禁止在 DouPHP 的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。
5.如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。

四、有限担保和免责声明
1.本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。
2.用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺对免费用户提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。
3.电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始确认本协议并安装DouPHP，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。
4.如果本软件带有其它软件的整合API示范例子包，这些文件版权不属于本软件官方，并且这些文件是没经过授权发布的，请参考相关软件的使用许可合法的使用。

DouPHP 的官方网址是：www.douco.com 交流论坛：bbs.douco.cn</textarea>
    <div class="agree">
     <label>
      <input name="confirm" type="checkbox" onclick="agree();" align="absMiddle" id="btn_license"/>
      <b><?php echo $this->_tpl_vars['lang']['welcome_agree']; ?>
</b></label>
    </div>
   </ul>
   <p class="action">
    <input type="button" class="btnGray" name="submit" value="<?php echo $this->_tpl_vars['lang']['next']; ?>
" disabled="disabled" id="submit" onclick="location.href='index.php?step=check'"/>
   </p>
  </form>
 </div>
</div>
</body>
</html>