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
$smarty->assign('cur', 'page');

/**
 * +----------------------------------------------------------
 * 单页面列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $smarty->assign('ur_here', $_LANG['page_list']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['page_add'],
            'href' => 'page.php?rec=add' 
    ));
    
    // 赋值给模板
    $smarty->assign('page_list', $dou->get_page_nolevel());
    
    $smarty->display('page.htm');
} 

/**
 * +----------------------------------------------------------
 * 单页面添加
 * +----------------------------------------------------------
 */
elseif ($rec == 'add') {
    $smarty->assign('ur_here', $_LANG['page_add']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['page_list'],
            'href' => 'page.php' 
    ));
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('page_add'));
    
    // 赋值给模板
    $smarty->assign('form_action', 'insert');
    $smarty->assign('page_list', $dou->get_page_nolevel());
    
    $smarty->display('page.htm');
} 

elseif ($rec == 'insert') {
    if (empty($_POST['page_name']))
        $dou->dou_msg($_LANG['page_name'] . $_LANG['is_empty']);
        
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'page_add');
    
    $sql = "INSERT INTO " . $dou->table('page') . " (id, unique_id, parent_id, page_name, content ,keywords, description)" .
             " VALUES (NULL, '$_POST[unique_id]', '$_POST[parent_id]', '$_POST[page_name]', '$_POST[content]', '$_POST[keywords]', '$_POST[description]')";
    $dou->query($sql);
    
    if (!$check->is_unique_id($_POST['unique_id'])) {
        $dou->dou_msg($_LANG['unique_id_wrong'], 'page.php?rec=edit&id=' . mysql_insert_id(), '', '5');
    }
    
    $dou->create_admin_log($_LANG['page_add'] . ': ' . $_POST[page_name]);
    $dou->dou_msg($_LANG['page_add_succes'], 'page.php');
} 

/**
 * +----------------------------------------------------------
 * 单页面编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
    $smarty->assign('ur_here', $_LANG['page_edit']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['page_list'],
            'href' => 'page.php' 
    ));
    
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    
    $query = $dou->select($dou->table('page'), '*', '`id` = \'' . $id . '\'');
    $page = $dou->fetch_array($query);
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('page_edit'));
    
    // 赋值给模板
    $smarty->assign('form_action', 'update');
    $smarty->assign('page_list', $dou->get_page_nolevel(0, 0, $id));
    $smarty->assign('page', $page);
    
    $smarty->display('page.htm');
} 

elseif ($rec == 'update') {
    if (empty($_POST['page_name']))
        $dou->dou_msg($_LANG['page_name'] . $_LANG['is_empty']);
        
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'page_edit');
    
    $sql = "UPDATE " . $dou->table('page') .
             " SET unique_id = '$_POST[unique_id]', parent_id = '$_POST[parent_id]', page_name = '$_POST[page_name]', content = '$_POST[content]', keywords = '$_POST[keywords]', description = '$_POST[description]' WHERE id = '$_POST[id]'";
    $dou->query($sql);
    
    if (!$check->is_unique_id($_POST['unique_id'])) {
        $dou->dou_msg($_LANG['unique_id_wrong'], 'page.php?rec=edit&id=' . $_POST['id'], '', '5');
    }
    
    $dou->create_admin_log($_LANG['page_edit'] . ': ' . $_POST['page_name']);
    $dou->dou_msg($_LANG['page_edit_succes'], 'page.php', '', '3');
} 

/**
 * +----------------------------------------------------------
 * 单页面删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $dou->dou_msg($_LANG['illegal'], 'page.php');
    
    $page_name = $dou->get_one("SELECT page_name FROM " . $dou->table('page') . " WHERE id = '$id'");
    $is_parent = $dou->get_one("SELECT id FROM " . $dou->table('page') . " WHERE parent_id = '$id'");
    
    if ($id == '1') {
        $dou->dou_msg($_LANG['page_del_wrong'], 'page.php', '', '3');
    } elseif ($is_parent) {
        $_LANG['page_del_is_parent'] = preg_replace('/d%/Ums', $page_name, $_LANG['page_del_is_parent']);
        $dou->dou_msg($_LANG['page_del_is_parent'], 'page.php', '', '3');
    } else {
        if (isset($_POST['confirm']) ? $_POST['confirm'] : '') {
            $dou->create_admin_log($_LANG['page_del'] . ': ' . $page_name);
            $dou->delete($dou->table('page'), "id = $id", 'page.php');
        } else {
            $_LANG['del_check'] = preg_replace('/d%/Ums', $page_name, $_LANG['del_check']);
            $dou->dou_msg($_LANG['del_check'], 'page.php', '', '30', "page.php?rec=del&id=$id");
        }
    }
}
?>