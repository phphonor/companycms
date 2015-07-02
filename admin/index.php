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

/**
 * +----------------------------------------------------------
 * 系统信息
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $sys_info['os'] = PHP_OS;
    $sys_info['ip'] = $_SERVER['SERVER_ADDR'];
    $sys_info['web_server'] = $_SERVER['SERVER_SOFTWARE'];
    $sys_info['php_ver'] = PHP_VERSION;
    $sys_info['mysql_ver'] = $dou->version();
    $sys_info['zlib'] = function_exists('gzclose') ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['safe_mode'] = (boolean) ini_get('safe_mode') ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['safe_mode_gid'] = (boolean) ini_get('safe_mode_gid') ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['timezone'] = function_exists("date_default_timezone_get") ? date_default_timezone_get() : $_LANG['no_timezone'];
    $sys_info['socket'] = function_exists('fsockopen') ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['gd'] = extension_loaded("gd") ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['charset'] = strtoupper(DOU_CHARSET);
    $sys_info['build_date'] = date("Y-m-d", $_CFG['build_date']);
    $sys_info['logo'] = ROOT_URL . 'theme/' . $_CFG['site_theme'] . '/images/' . $_CFG['site_logo'];
    $sys_info['max_filesize'] = ini_get('upload_max_filesize');
    $sys_info['num_page'] = mysql_num_rows($dou->query("SELECT * FROM " . $dou->table('page')));
    $sys_info['num_product'] = mysql_num_rows($dou->query("SELECT * FROM " . $dou->table('product')));
    $sys_info['num_article'] = mysql_num_rows($dou->query("SELECT * FROM " . $dou->table('article')));
    
    // 提示应该被删除的目录未被删除
    if ($check->is_write(ROOT_PATH . 'install') != 2)
        $warning[] = $_LANG['warning_install_exists'];
    if ($check->is_write(ROOT_PATH . 'upgrade') != 2)
        $warning[] = $_LANG['warning_upgrade_exists'];
    $sys_info['folder_exists'] = $warning;
    
    // 获取单页面信息
    $page_list = $dou->get_page_nolevel();
    
    // 获取更新提示
    $dou_api = $dou->dou_api();
    
    // 赋值给模板
    $smarty->assign('dou_api', $dou_api);
    $smarty->assign('cur', 'index');
    $smarty->assign('page_list', $page_list);
    $smarty->assign('sys_info', $sys_info);
    $smarty->assign("log_list", $dou->get_admin_log($_SESSION[DOU_ID]['user_id'], 6));
    
    $smarty->display('index.htm');
} 

/**
 * +----------------------------------------------------------
 * 关于我们
 * +----------------------------------------------------------
 */
elseif ($rec == 'about') {
    $smarty->display('index.htm');
} 

/**
 * +----------------------------------------------------------
 * 清除缓存及已编译模板
 * +----------------------------------------------------------
 */
elseif ($rec == 'clear_cache') {
    $dou->dou_clear_cache(ROOT_PATH . "cache");
    $dou->dou_msg($_LANG['clear_cache_success']);
}

?>