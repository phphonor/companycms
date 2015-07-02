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
define('ROUTE', true);

// 获取和方向标值
$route = $_REQUEST['route'];
$parts = explode('/', $route);

$site_path = str_replace('include/route.php', '', str_replace('\\', '/', __FILE__));

// 方向标函数生成系统模块关键值
$mark = seo_url($route, $parts);

// 方向标
if (is_array($mark)) {
    foreach ($mark as $key => $value) {
        if ($value)
            $_REQUEST[$key] = $value;
    }
    
    $site_path . $mark['module'] . '.php';
    require ($site_path . $mark['module'] . '.php');
}

/**
 * +----------------------------------------------------------
 * 方向标
 * +----------------------------------------------------------
 */
function seo_url($route, $parts) {
	   $parts[1] = isset($parts[1]) ? $parts[1] : '';
	   $parts[2] = isset($parts[2]) ? $parts[2] : '';
				
    if (preg_match("/^([a-z0-9-]+)\.html$/", $parts[0])) {
        $mark['module'] = 'page';
        $mark['unique_id'] = str_replace('.html', '', $parts[0]);
    } elseif (preg_match("/^(product|news)$/", $parts[0])) {
        if (strpos($route, '.html')) {
            $mark['module'] = $parts[0] == 'news' ? 'article' : $parts[0];
            $mark['unique_id'] = !preg_match("/^([0-9]+)\.html$/", $parts[1]) ? $parts[1] : '';
            $mark['id'] = str_replace('.html', '', basename($route));
        } else {
            $mark['module'] = ($parts[0] == 'news' ? 'article' : $parts[0]) . '_category';
            if (preg_match("/^o([0-9]+)$/", $parts[1])) {
                $mark['page'] = str_replace('o', '', $parts[1]);
            } else {
                $mark['unique_id'] = $parts[1];
                if (preg_match("/^o([0-9]+)$/", $parts[2])) {
                    $mark['page'] = str_replace('o', '', $parts[2]);
                }
            }
        }
    } elseif (preg_match("/^(guestbook|catalog)$/", $parts[0])) {
        $mark['module'] = $parts[0];
        if (preg_match("/^o([0-9]+)$/", $parts[1])) {
            $mark['page'] = str_replace('o', '', $parts[1]);
        } else {
            $mark['rec'] = $parts[1];
            if (preg_match("/^o([0-9]+)$/", $parts[2]))
                $mark['page'] = str_replace('o', '', $parts[2]);
        }
    }
    
    return $mark;
}

?>