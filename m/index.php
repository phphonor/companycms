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

// 如果存在搜索词则转入搜索页面
if ($_REQUEST['s']) {
    if ($check->is_text($keyword = trim($_REQUEST['s']))) {
        require (ROOT_PATH . M_PATH . '/include/search.inc.php');
    } else {
        $dou->dou_msg($_LANG['search_keyword_wrong']);
    }
}

// 获取关于我们信息
$sql = "SELECT * FROM " . $dou->table('page') . " WHERE id = '1'";
$query = $dou->query($sql);
$about = $dou->fetch_array($query);

// 写入到index数组
$index['product_link'] = $dou->rewrite_url('product_category');
$index['article_link'] = $dou->rewrite_url('article_category');
$index['cur'] = true;

// 赋值给模板-meta和title信息
$smarty->assign('page_title', $dou->page_title());
$smarty->assign('keywords', $_CFG['mobile_keywords']);
$smarty->assign('description', $_CFG['mobile_description']);

// 赋值给模板-导航栏
$smarty->assign('nav_list', is_array($dou->get_nav()) ? $dou->get_nav() : $dou->get_nav('middle'));

// 赋值给模板-数据
$smarty->assign('show_list', is_array($dou->get_show_list('mobile')) ? $dou->get_show_list('mobile') : $dou->get_show_list('pc'));
$smarty->assign('index', $index);
$smarty->assign('recommend_product', $dou->get_product_list('ALL', $_CFG['mobile_home_display_product'], 'recommend'));
$smarty->assign('recommend_article', $dou->get_article_list('ALL', $_CFG['mobile_home_display_article'], 'recommend'));

$smarty->display('index.dwt');
?>