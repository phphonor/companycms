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

// 验证并获取合法的ID，如果不合法将其设定为-1
$id = $firewall->get_legal_id('page', $_REQUEST['id'], $_REQUEST['unique_id']);
if ($id == -1)
    $dou->dou_msg($GLOBALS['_LANG']['page_wrong'], ROOT_URL);
    
    // 获取单页面信息
$page = get_page_info($id);
$top_id = $page['parent_id'] == 0 ? $id : $page['parent_id'];

// 赋值给模板-meta和title信息
$smarty->assign('page_title', $dou->page_title($page['page_name']));
$smarty->assign('keywords', $page['keywords']);
$smarty->assign('description', $page['description']);

// 赋值给模板-导航栏
$smarty->assign('nav_top_list', $dou->get_nav('top'));
$smarty->assign('nav_middle_list', $dou->get_nav('middle', '0', 'page', $id));
$smarty->assign('nav_bottom_list', $dou->get_nav('bottom'));

// 赋值给模板-数据
$smarty->assign('head', $dou->head($page['page_name']));
$smarty->assign('page_list', $dou->get_page_list($top_id, $id));
$smarty->assign('top', get_page_info($top_id));
$smarty->assign('page', $page);
if ($top_id == $id) {
    $smarty->assign("top_cur", 'top_cur');
}

$smarty->display('page.dwt');

/**
 * +----------------------------------------------------------
 * 获取单页面信息
 * +----------------------------------------------------------
 */
function get_page_info($id = 0) {
    $query = $GLOBALS['dou']->select($GLOBALS['dou']->table('page'), '*', '`id` = \'' . $id . '\'');
    $page = $GLOBALS['dou']->fetch_array($query);
    
    if ($page) {
        $page['url'] = $GLOBALS['dou']->rewrite_url('page', $page['id']);
    }
    
    return $page;
}
?>