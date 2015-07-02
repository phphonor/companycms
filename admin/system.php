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
include_once (ROOT_PATH . 'include/upload.class.php');

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 赋值给模板
$smarty->assign('cur', 'system');

/**
 * +----------------------------------------------------------
 * 系统设置
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('system'));
    
    // 赋值给模板
    $smarty->assign('ur_here', $_LANG['system']);
    $smarty->assign('cfg_list_main', get_cfg_list());
    $smarty->assign('cfg_list_display', get_cfg_list('display'));
    $smarty->assign('cfg_list_defined', get_cfg_list('defined'));
    
    $smarty->display('system.htm');
}

/**
 * +----------------------------------------------------------
 * 系统设置数据更新
 * +----------------------------------------------------------
 */
if ($rec == 'update') {
    // 上传图片生成
    if ($_FILES['site_logo']['name'] != "") {
        $logo_dir = ROOT_PATH . "theme/" . $_POST['site_theme'] . "/images/"; // logo上传路径,结尾加斜杠
        $logo = new Upload($logo_dir, ''); // 实例化类文件
        $upfile = $logo->upload_image('site_logo', 'logo'); // 上传的文件域
        $_POST['site_logo'] = $upfile;
    }
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'system');
    
    foreach ($_POST as $name => $value) {
        $sql = "update " . $dou->table('config') . " SET value = '$value' WHERE name = '$name'";
        $dou->query($sql);
    }
    
    $dou->create_admin_log($_LANG['system'] . ': ' . $_LANG['edit_succes']);
    
    // 进行模板切换操作后需要清除缓存
    if ($_POST['site_theme'] != $_CFG['site_theme']) {
        $dou->dou_clear_cache(ROOT_PATH . "cache");
    }
    
    $dou->dou_msg($_LANG['edit_succes'], 'system.php');
}

/**
 * +----------------------------------------------------------
 * 获取系统设置列表
 * +----------------------------------------------------------
 */
function get_cfg_list($tab = 'main') {
    $sql = "SELECT * FROM " . $GLOBALS['dou']->table('config') . " WHERE type != 'hidden' AND tab = '$tab' ORDER BY sort ASC";
    $query = $GLOBALS['dou']->query($sql);
    while ($row = $GLOBALS['dou']->fetch_array($query)) {
        if ($row['box']) {
            $box = explode(",", $row['box']);
        }
        if ($row['name'] == 'site_logo') {
            $row['value'] = $row['value'] ? "theme/" . $GLOBALS['_CFG']['site_theme'] . "/images/" . $row['value'] : '';
        }
        if ($row['name'] == 'site_theme') {
            $box = $GLOBALS['dou']->get_subdirs(ROOT_PATH . 'theme');
        }
        if ($row['name'] == 'language') {
            $box = $GLOBALS['dou']->get_subdirs(ROOT_PATH . 'languages');
        }
        
        $cue = $GLOBALS['_LANG'][$row['name'] . '_cue'];
        
        if ($row['name'] == 'rewrite') {
            // 根据 Web 服务器信息 判断伪静态文件
            if (stristr($_SERVER['SERVER_SOFTWARE'], "Apache")) {
                $rewrite_file = ".htaccess";
            } elseif (stristr($_SERVER['SERVER_SOFTWARE'], "IIS")) {
                $iis_exp = explode("/", $_SERVER['SERVER_SOFTWARE']);
                $iis_ver = $iis_exp['1'];
                
                if ($iis_ver >= 7.0) {
                    $rewrite_file = "web.config";
                } else {
                    $rewrite_file = "httpd.ini";
                }
            }
            
            if (stristr($_SERVER['SERVER_SOFTWARE'], "nginx")) {
                $cue = $GLOBALS['_LANG'][$row['name'] . '_cue_nginx'];
            } elseif ($rewrite_file) {
                $cue = preg_replace('/d%/Ums', $rewrite_file, $cue);
            } else {
                $cue = $GLOBALS['_LANG'][$row['name'] . '_cue_other'];
            }
        }
        
        $cfg_list[] = array (
                "value" => $row['value'],
                "name" => $row['name'],
                "type" => $row['type'],
                "box" => $box,
                "lang" => $GLOBALS['_LANG'][$row['name']],
                "cue" => $cue 
        );
    }
    
    return $cfg_list;
}
?>