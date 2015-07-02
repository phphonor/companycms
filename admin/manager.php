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

require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

$smarty->assign('rec', $rec);

/**
 * +----------------------------------------------------------
 * 管理员列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $smarty->assign('ur_here', $_LANG['manager']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['manager_add'],
            'href' => 'manager.php?rec=add' 
    ));
    
    $sql = "SELECT * FROM " . $dou->table('admin') . " ORDER BY user_id ASC";
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $add_time = date("Y-m-d", $row['add_time']);
        $last_login = date("Y-m-d H:i:s", $row['last_login']);
        
        $manager_list[] = array (
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "email" => $row['email'],
                "action_list" => $row['action_list'],
                "add_time" => $add_time,
                "last_login" => $last_login 
        );
    }
    
    // 赋值给模板
    $smarty->assign('cur', 'manager');
    $smarty->assign('manager_list', $manager_list);
    
    $smarty->display('manager.htm');
} 

/**
 * +----------------------------------------------------------
 * 管理员添加处理
 * +----------------------------------------------------------
 */
elseif ($rec == 'add') {
    if ($_USER['action_list'] != 'ALL') {
        $dou->dou_msg($_LANG['without'], 'manager.php');
    }
    
    $smarty->assign('ur_here', $_LANG['manager']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['manager_list'],
            'href' => 'manager.php' 
    ));
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('manager_add'));
    
    $smarty->display('manager.htm');
} 

elseif ($rec == 'insert') {
    // 验证用户名
    if (!$check->is_username($_POST['user_name']))
        $dou->dou_msg($_LANG['manager_username_cue']);
        
    // 验证密码
    if (!$check->is_password($_POST['password']))
        $dou->dou_msg($_LANG['manager_password_cue']);
        
    // 验证确认密码
    if ($_POST['password_confirm'] !== $_POST['password'])
        $dou->dou_msg($_LANG['manager_password_confirm_cue']);
    
    $password = md5($_POST['password']);
    $add_time = time();
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'manager_add');
    
    $sql = "INSERT INTO " . $dou->table('admin') . " (user_id, user_name, password, action_list, add_time)" .
             " VALUES (NULL, '$_POST[user_name]', '$password', 'ADMIN', '$add_time')";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['manager_add'] . ': ' . $_POST['user_name']);
    
    $dou->dou_msg($_LANG['manager_add_succes'], 'manager.php');
} 

/**
 * +----------------------------------------------------------
 * 管理员编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
    $smarty->assign('ur_here', $_LANG['manager']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['manager_list'],
            'href' => 'manager.php' 
    ));
    
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    
    $query = $dou->select($dou->table('admin'), '*', '`user_id` = \'' . $id . '\'');
    $manager_info = $dou->fetch_array($query);
    
    if ($_USER['action_list'] != 'ALL' && $manager_info['user_name'] != $_USER['user_name']) {
        $dou->dou_msg($_LANG['without'], 'manager.php');
    }
    
    // 超级管理员修改普通管理员信息无需旧密码
    if ($_USER['action_list'] == 'ALL' && $manager_info['user_name'] != $_USER['user_name']) {
        $if_check = false;
    } else {
        $if_check = true;
    }
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('manager_edit'));
    
    $smarty->assign('if_check', $if_check);
    $smarty->assign('manager_info', $manager_info);
    
    $smarty->display('manager.htm');
} 

elseif ($rec == 'update') {
    $query = $dou->select($dou->table('admin'), '*', '`user_id` = \'' . $_POST['id'] . '\'');
    $manager_info = $dou->fetch_array($query);
    
    // 判断管理员账号是否符合规范
    if (!$check->is_username($_POST['user_name'])) {
        $dou->dou_msg($_LANG['manager_username_cue']);
    }
    
    // 超级管理员修改普通管理员信息无需旧密码
    if (!($_USER['action_list'] == 'ALL' && $manager_info['user_name'] != $_USER['user_name'])) {
        if (!$_POST['old_password']) {
            $dou->dou_msg($_LANG['manager_old_password_cue']);
        } elseif (md5($_POST['old_password']) != $manager_info['password']) {
            $dou->create_admin_log($_LANG['manager_edit'] . ': ' . $_POST['user_name'] . " ( " . $_LANG['manager_old_password_cue'] . " )");
            $dou->dou_msg($_LANG['manager_old_password_cue']);
        }
    }
    
    // 如果有输入新密码，则验证新密码
    if ($_POST['password']) {
        if (!$check->is_password($_POST['password'])) {
            $dou->dou_msg($_LANG['manager_password_cue']);
        } elseif ($_POST['password_confirm'] != $_POST['password']) {
            $dou->dou_msg($_LANG['manager_password_confirm_cue']);
        }
        
        $update_password = ", password = '" . md5($_POST['password']) . "'";
    }
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'manager_edit');
    
    $sql = "UPDATE " . $dou->table('admin') . " SET user_name = '$_POST[user_name]'" . $update_password . " WHERE user_id = '$_POST[id]'";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['manager_edit'] . ': ' . $_POST['user_name']);
    
    $dou->dou_msg($_LANG['manager_edit_succes'], 'manager.php');
} 

/**
 * +----------------------------------------------------------
 * 管理员删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    // 验证并获取合法的ID
    $user_id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $dou->dou_msg($_LANG['illegal'], 'manager.php');
    
    $user_name = $dou->get_one("SELECT user_name FROM " . $dou->table('admin') . " WHERE user_id = '$user_id'");
    
    if ($user_name == $_USER['user_name']) {
        $dou->dou_msg($_LANG['manager_del_wrong'], 'manager.php', '', '3');
    } else {
        if (isset($_POST['confirm']) ? $_POST['confirm'] : '') {
            $dou->create_admin_log($_LANG['manager_del'] . ': ' . $user_name);
            $dou->delete($dou->table('admin'), "user_id = $user_id", 'manager.php');
        } else {
            $_LANG['del_check'] = preg_replace('/d%/Ums', $user_name, $_LANG['del_check']);
            $dou->dou_msg($_LANG['del_check'], 'manager.php', '', '30', "manager.php?rec=del&id=$user_id");
        }
    }
} 

/**
 * +----------------------------------------------------------
 * 操作记录
 * +----------------------------------------------------------
 */
elseif ($rec == 'manager_log') {
    $smarty->assign('ur_here', $_LANG['manager_log']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['manager_list'],
            'href' => 'manager.php' 
    ));
    $smarty->assign('cur', 'manager_log');
    
    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager('admin_log', 15, $page);
    
    $sql = "SELECT * FROM " . $dou->table('admin_log') . $where . " ORDER BY id DESC" . $limit;
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $create_time = date("Y-m-d", $row['create_time']);
        $user_name = $dou->get_one("SELECT user_name FROM " . $dou->table('admin') . " WHERE user_id = " . $row['user_id']);
        
        $log_list[] = array (
                "id" => $row['id'],
                "create_time" => $create_time,
                "user_name" => $user_name,
                "action" => $row['action'],
                "ip" => $row['ip'] 
        );
    }
    
    // 赋值给模板
    $smarty->assign('log_list', $log_list);
    
    $smarty->display('manager.htm');
}

?>