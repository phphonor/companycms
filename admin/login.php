<?php
/**
 * DouPHP
 * --------------------------------------------------------------------------------------------------
 * 版权所有 2013-2014 漳州豆壳网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.douco.com
 * --------------------------------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
 * 授权协议：http://www.douco.com/license.html
 * --------------------------------------------------------------------------------------------------
 * Author: DouCo
 * Release Date: 2014-06-05
 */
define('IN_DOUCO', true);
define('NO_CHECK', true);

require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 赋值给模板
$smarty->assign('rec', $rec);

/**
 * +----------------------------------------------------------
 * 登录页
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $smarty->display('login.htm');
} 

/**
 * +----------------------------------------------------------
 * 登录验证
 * +----------------------------------------------------------
 */
elseif ($rec == 'login') {
    if ($check->is_captcha(trim($_POST['vcode'])) && $_CFG['captcha']) {
        $_POST['vcode'] = strtoupper(trim($_POST['vcode']));
    }
    
    if (!$_POST['user_name']) {
        $dou->dou_msg($_LANG['login_input_wrong'], 'login.php', 'out');
    } elseif (md5($_POST['vcode'] . DOU_SHELL) != $_SESSION['captcha'] && $_CFG['captcha']) {
        $dou->dou_msg($_LANG['login_vcode_wrong'], 'login.php', 'out');
    }
    
    $_POST['user_name'] = $check->is_username(trim($_POST['user_name'])) ? trim($_POST['user_name']) : '';
    $_POST['password'] = $check->is_password(trim($_POST['password'])) ? trim($_POST['password']) : '';
    
    $query = $dou->select($dou->table(admin), '*', "user_name = '$_POST[user_name]'");
    $user = $dou->fetch_array($query);
    
    if (!is_array($user)) {
        $dou->create_admin_log($_LANG['login_action'] . ': ' . $_POST['user_name'] . " ( " . $_LANG['login_user_name_wrong'] . " ) ");
        $dou->dou_msg($_LANG['login_input_wrong'], 'login.php', 'out');
    } elseif (md5($_POST['password']) != $user['password']) {
        if ($_POST['password']) {
            $dou->create_admin_log($_LANG['login_action'] . ': ' . $_POST['user_name'] . " ( " . $_LANG['login_password_wrong'] . " ) ");
        }
        $dou->dou_msg($_LANG['login_input_wrong'], 'login.php', 'out');
    }
    
    $_SESSION[DOU_ID]['user_id'] = $user['user_id'];
    $_SESSION[DOU_ID]['shell'] = md5($user['user_name'] . $user['password'] . DOU_SHELL);
    $_SESSION[DOU_ID]['ontime'] = time();
    
    $last_login = time();
    $last_ip = $dou->get_ip();
    $sql = "update " . $dou->table('admin') . " SET last_login = '$last_login', last_ip = '$last_ip' WHERE user_id = " . $user['user_id'];
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['login_action'] . ': ' . $_LANG['login_success']);
    
    header("Location: " . ROOT_URL . ADMIN_PATH . "/index.php\n");
    exit();
} 

/**
 * +----------------------------------------------------------
 * 退出登录
 * +----------------------------------------------------------
 */
elseif ($rec == 'logout') {
    unset($_SESSION[DOU_ID]);
    header("Location: " . ROOT_URL . ADMIN_PATH . "/login.php\n");
}
?>