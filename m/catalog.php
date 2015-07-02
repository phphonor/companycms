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
$rec = $check->is_letter($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 赋值给模板-meta和title信息
$smarty->assign('page_title', $dou->page_title($_LANG['catalog']));
$smarty->assign('keywords', $_LANG['catalog']);
$smarty->assign('description', $_LANG['catalog']);

// 赋值给模板-导航栏
$smarty->assign('nav_top_list', $dou->get_nav('top'));
$smarty->assign('nav_middle_list', $dou->get_nav('middle'));
$smarty->assign('nav_bottom_list', $dou->get_nav('bottom'));

// 赋值给模板-数据
$smarty->assign('catalog', get_catalog());
$smarty->assign('head', $dou->head($_LANG['catalog']));

$smarty->display('catalog.dwt');

/**
 * +----------------------------------------------------------
 * 获取整站目录数据
 * +----------------------------------------------------------
 */
function get_catalog() {
    // 单页面列表
    $page_list = $GLOBALS['dou']->get_page_nolevel();
    foreach ($page_list as $row) {
        $page_array[] = array (
                "name" => $row['page_name'],
                "mark" => '-' . $row['mark'],
                "url" => $row['url'] 
        );
    }
    
    $catalog = $page_array;
    
    // 产品分类列表
    $product_category = $GLOBALS['dou']->get_category_nolevel('product_category');
    $product_category_array[] = array (
            "name" => $GLOBALS['_LANG']['product_category'],
            "url" => $GLOBALS['dou']->rewrite_url('product_category') 
    );
    foreach ($product_category as $row) {
        $product_category_array[] = array (
                "name" => $row['cat_name'],
                "mark" => '-' . $row['mark'],
                "url" => $row['url'] 
        );
    }
    
    $catalog = array_merge($catalog, $product_category_array);
    
    // 文章分类列表
    $article_category = $GLOBALS['dou']->get_category_nolevel('article_category');
    $article_category_array[] = array (
            "name" => $GLOBALS['_LANG']['article_category'],
            "url" => $GLOBALS['dou']->rewrite_url('article_category') 
    );
    foreach ($article_category as $row) {
        $article_category_array[] = array (
                "name" => $row['cat_name'],
                "mark" => '-' . $row['mark'],
                "url" => $row['url'] 
        );
    }
    
    $catalog = array_merge($catalog, $article_category_array);
    
    // 其它模块
    $guestbook[] = array (
            "name" => $GLOBALS['_LANG']['guestbook'],
            "url" => $GLOBALS['dou']->rewrite_url('guestbook') 
    );
    
    $catalog = array_merge($catalog, $guestbook);
    
    return $catalog;
}

?>