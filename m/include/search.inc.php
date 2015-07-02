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
if (!defined('IN_DOUCO')) {
    die('Hacking attempt');
}

// 初始化
$module = $check->is_letter($_REQUEST['module']) ? $_REQUEST['module'] : 'product';
switch ($module) {
    case 'product' : // 产品模块
        $image_field = 'product_image';
        $name_field = 'product_name';
        $smarty->assign('keyword', $keyword);
        break;
    default :
        $image_field = 'image';
        $name_field = 'title';
        $smarty->assign('keyword_article', $keyword);
}

// 获取分页信息
$page = $check->is_number($_REQUEST['p']) ? $_REQUEST['p'] : 1;
$limit = $dou->pager($module, $_CFG['display_product'], $page, '', $keyword);

/* 获取搜索结果列表 */
$sql = "SELECT * FROM " . $dou->table($module) . " WHERE " . $name_field . " LIKE '%$keyword%' ORDER BY id DESC" . $limit;
$query = $dou->query($sql);

while ($row = $dou->fetch_array($query)) {
    $cat_name = $dou->get_one("SELECT cat_name FROM " . $dou->table('product_category') . " WHERE cat_id = '$row[cat_id]'");
    $url = $dou->rewrite_url($module, $row['id']);
    $add_time = date("Y-m-d", $row['add_time']);
    $add_time_short = date("m-d", $row['add_time']);
    
    $description = $row['description'] ? $row['description'] : $dou->dou_substr($row['content'], 150);
    
    // 生成缩略图的文件名
    $image = explode('.', $row[$image_field]);
    $thumb = ROOT_URL . $image[0] . '_thumb.' . $image[1];
    if ($row['price'] > 0) {
        $price = $dou->price_format($row['price']);
    } else {
        $price = $_LANG['price_discuss'];
    }
    
    $search_list[] = array (
            "id" => $row['id'],
            "cat_id" => $row['cat_id'],
            "name" => $row[$name_field],
            "title" => $row[$name_field],
            "price" => $price,
            "thumb" => $thumb,
            "cat_name" => $cat_name,
            "add_time" => $add_time,
            "add_time_short" => $add_time_short,
            "click" => $row['click'],
            "description" => $description,
            "url" => $url 
    );
}

$search_results = preg_replace('/d%/Ums', $keyword, $_LANG['search_results']);

// 赋值给模板-meta和title信息
$smarty->assign('page_title', $dou->page_title($search_results));
$smarty->assign('keywords', $_CFG['site_keywords']);
$smarty->assign('description', $_CFG['site_description']);

// 赋值给模板-导航栏
$data = $dou->fetch_array_all('nav', 'sort ASC');
$smarty->assign('nav_top_list', $dou->get_nav('top'));
$smarty->assign('nav_middle_list', $dou->get_nav('middle'));
$smarty->assign('nav_bottom_list', $dou->get_nav('bottom'));

// 赋值给模板-数据
$smarty->assign('head', $dou->head($_LANG['search']));
$smarty->assign('search_module', $module);
$smarty->assign('product_category', $dou->get_category('product_category'));
$smarty->assign('article_category', $dou->get_category('article_category'));
$smarty->assign('search_list', $search_list);

$smarty->display('search.dwt');

// 终止执行文件外的程序
exit();

?>