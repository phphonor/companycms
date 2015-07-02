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

// 赋值给模板
$smarty->assign('rec', $rec);
$smarty->assign('cur', $cur = 'nav');

/**
 * +----------------------------------------------------------
 * 导航列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $smarty->assign('ur_here', $_LANG['nav']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['nav_add'],
            'href' => 'nav.php?rec=add' 
    ));
    
    // 获得请求的导航类型
    $type = $check->is_letter($_REQUEST['type']) ? $_REQUEST['type'] : 'middle';
    
    // 赋值给模板
    $smarty->assign('type', $type);
    $smarty->assign('nav_list', $dou->get_nav($type));
    
    $smarty->display('nav.htm');
} 

/**
 * +----------------------------------------------------------
 * 导航添加处理
 * +----------------------------------------------------------
 */
elseif ($rec == 'add') {
    $smarty->assign('ur_here', $_LANG['nav']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['nav_list'],
            'href' => 'nav.php' 
    ));
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('nav_add'));
    
    // 赋值给模板
    $smarty->assign('catalog', $dou->get_catalog());
    $smarty->assign('nav_list', $dou->get_nav('middle'));
    
    $smarty->display('nav.htm');
} 

elseif ($rec == 'insert') {
    $nav_menu = explode(',', $_POST['nav_menu']);
    $module = $nav_menu[0];
    $guide = $module == 'nav' ? trim($_POST['guide']) : $nav_menu[1];
    
    if (empty($_POST['nav_name']))
        $dou->dou_msg($_LANG['nav_name'] . $_LANG['is_empty']);
        
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'nav_add');
    
    $sql = "INSERT INTO " . $dou->table('nav') . " (id, module, nav_name, guide, parent_id, type, sort)" .
             " VALUES (NULL, '$module', '$_POST[nav_name]', '$guide', '$_POST[parent_id]', '$_POST[type]', '$_POST[sort]')";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['nav_add'] . ': ' . $_POST['nav_name']);
    
    $dou->dou_msg($_LANG['nav_add_succes'], 'nav.php?type=' . $_POST['type']);
} 

/**
 * +----------------------------------------------------------
 * 导航编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
    $smarty->assign('ur_here', $_LANG['nav']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['nav_list'],
            'href' => 'nav.php' 
    ));
    
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    
    $query = $dou->select($dou->table('nav'), '*', '`id` = \'' . $id . '\'');
    $nav_info = $dou->fetch_array($query);
    
    // 格式化数据
    $nav_info['url'] = $nav_info['module'] == 'nav' ? $nav_info['guide'] : $dou->rewrite_url($nav_info['module'], $nav_info['guide']);
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('nav_edit'));
    
    // 赋值给模板
    $smarty->assign('catalog', $dou->get_catalog($nav_info['module'], $nav_info['guide']));
    $smarty->assign('nav_list', $dou->get_nav($nav_info['type'], '0', '0', $id));
    $smarty->assign('nav_info', $nav_info);
    
    $smarty->display('nav.htm');
} 

elseif ($rec == 'update') {
    if (empty($_POST['nav_name']))
        $dou->dou_msg($_LANG['nav_name'] . $_LANG['is_empty']);
        
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'nav_edit');
    
    /* 判断是站内还是站外导航 */
    if ($_POST['nav_menu']) {
        $nav_menu = explode(',', $_POST['nav_menu']);
        $update = ", module='$nav_menu[0]', guide='$nav_menu[1]'";
    } else {
        $update = ", guide='$_POST[guide]'";
    }
    
    $sql = "UPDATE " . $dou->table('nav') . " SET nav_name = '$_POST[nav_name]'" . $update .
             ", parent_id = '$_POST[parent_id]', type = '$_POST[type]', sort = '$_POST[sort]' WHERE id = '$_POST[id]'";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['nav_edit'] . ': ' . $_POST['nav_name']);
    
    $dou->dou_msg($_LANG['nav_edit_succes'], 'nav.php?type=' . $_POST['type']);
} 

/**
 * +----------------------------------------------------------
 * 生成导航$select表单
 * +----------------------------------------------------------
 */
elseif ($rec == 'nav_select') {
    $type = $_GET['type'] ? trim($_GET['type']) : 'middle';
    $id = trim($_REQUEST['id']);
    $parent_id = $dou->get_one("SELECT parent_id FROM " . $dou->table('nav') . " WHERE id = '$id'");
    
    $nav_list = $dou->get_nav($type, '0', '0', $id);
    $select .= '<select name="parent_id">';
    $select .= '<option value="0">' . $_LANG['empty'] . '</option>';
    foreach ($nav_list as $value) {
        $select .= '<option value="' . $value['id'] . '" ';
        $select .= ($value['id'] == $parent_id) ? "selected='ture'" : '';
        $select .= '>' . $value['mark'] . ' ';
        $select .= htmlspecialchars($value['nav_name'], ENT_QUOTES) . '</option>';
    }
    $select .= '</select>';
    
    echo $select;
} 

/**
 * +----------------------------------------------------------
 * 导航删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $dou->dou_msg($_LANG['illegal'], 'nav.php');
    
    $query = $dou->select($dou->table('nav'), '*', '`id` = \'' . $id . '\'');
    $nav_info = $dou->fetch_array($query);
    
    $is_parent = $dou->get_one("SELECT id FROM " . $dou->table('nav') . " WHERE parent_id = '$id'");
    
    if ($is_parent) {
        $_LANG['nav_del_is_parent'] = preg_replace('/d%/Ums', $nav_info['nav_name'], $_LANG['nav_del_is_parent']);
        $dou->dou_msg($_LANG['nav_del_is_parent'], 'nav.php?type=' . $nav_info['type'], '', '3');
    } else {
        if (isset($_POST['confirm']) ? $_POST['confirm'] : '') {
            $dou->create_admin_log($_LANG['nav_del'] . ': ' . $nav_info['nav_name']);
            $dou->delete($dou->table('nav'), "id = $id", 'nav.php?type=' . $nav_info['type']);
        } else {
            $_LANG['del_check'] = preg_replace('/d%/Ums', $nav_info['nav_name'], $_LANG['del_check']);
            $dou->dou_msg($_LANG['del_check'], 'nav.php', '', '30', "nav.php?rec=del&id=$id");
        }
    }
}

?>