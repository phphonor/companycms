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

// 图片上传
include_once (ROOT_PATH . 'include/upload.class.php');
$images_dir = 'data/slide/'; // 文件上传路径 结尾加斜杠
$thumb_dir = 'thumb/'; // 缩略图路径（相对于$images_dir） 结尾加斜杠，留空则跟$images_dir相同
$img = new Upload(ROOT_PATH . $images_dir, $thumb_dir); // 实例化类文件
                                                        
// 赋值给模板
$smarty->assign('rec', $rec);
$smarty->assign('cur', 'show');
$smarty->assign('ur_here', $_LANG['show']);
$smarty->assign('show_list', $dou->get_show_list());

/**
 * +----------------------------------------------------------
 * 幻灯列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('show_add'));
    
    $smarty->display('show.htm');
} 

/**
 * +----------------------------------------------------------
 * 幻灯添加处理
 * +----------------------------------------------------------
 */
elseif ($rec == 'insert') {
    if (empty($_POST['show_name']))
        $dou->dou_msg($_LANG['show_name'] . $_LANG['is_empty']);
        
    // 上传图片生成
    $name = date('Ymd');
    for($i = 0; $i < 6; $i++) {
        $name .= chr(mt_rand(97, 122));
    }
    
    $upfile = $img->upload_image('show_img', $name); // 上传的文件域
    $file = $images_dir . $upfile;
    $img->to_file = true;
    $img->make_thumb($upfile, 100, 100);
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'show_add');
    
    $sql = "INSERT INTO " . $dou->table('show') . " (id, show_name, show_link, show_img, type, sort)" .
             " VALUES (NULL, '$_POST[show_name]', '$_POST[show_link]', '$file', 'pc', '$_POST[sort]')";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['show_add'] . ': ' . $_POST[show_name]);
    $dou->dou_msg($_LANG['show_add_succes'], 'show.php');
} 

/**
 * +----------------------------------------------------------
 * 幻灯编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    
    $query = $dou->select($dou->table('show'), '*', '`id` = \'' . $id . '\'');
    $show = $dou->fetch_array($query);
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('show_edit'));
    
    // 赋值给模板
    $smarty->assign('id', $id);
    $smarty->assign('show', $show);
    
    $smarty->display('show.htm');
} 

elseif ($rec == 'update') {
    if (empty($_POST['show_name']))
        $dou->dou_msg($_LANG['show_name'] . $_LANG['is_empty']);
        
    // 上传图片生成
    if ($_FILES['show_img']['name'] != "") {
        // 分析广告图片名称
        $basename = basename($_POST['show_img']);
        $file_name = substr($basename, 0, strrpos($basename, '.'));
        
        $upfile = $img->upload_image('show_img', "$file_name"); // 上传的文件域
        $file = $images_dir . $upfile;
        $img->to_file = true;
        $img->make_thumb($upfile, 100, 100);
        
        $up_file = ", image='$file'";
    }
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'show_edit');
    
    $sql = "update " . $dou->table('show') . " SET show_name='$_POST[show_name]'" . $up_file .
             " ,show_link = '$_POST[show_link]', sort = '$_POST[sort]' WHERE id = '$_POST[id]'";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['show_edit'] . ': ' . $_POST[show_name]);
    
    $dou->dou_msg($_LANG['show_edit_succes'], 'show.php');
} 

/**
 * +----------------------------------------------------------
 * 幻灯删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $dou->dou_msg($_LANG['illegal'], 'show.php');
    
    $show_name = $dou->get_one("SELECT show_name FROM " . $dou->table('show') . " WHERE id = '$id'");
    
    if (isset($_POST['confirm']) ? $_POST['confirm'] : '') {
        // 删除相应商品图片
        $show_img = $dou->get_one("SELECT show_img FROM " . $dou->table('show') . " WHERE id = '$id'");
        $file_name = basename($show_img);
        $image = explode(".", $file_name);
        $show_img_thumb = $images_dir . $thumb_dir . $image['0'] . "_thumb." . $image['1'];
        @ unlink(ROOT_PATH . $show_img);
        @ unlink(ROOT_PATH . $show_img_thumb);
        
        $dou->create_admin_log($_LANG['show_del'] . ': ' . $show_name);
        $dou->delete($dou->table('show'), "id = $id", 'show.php');
    } else {
        $_LANG['del_check'] = preg_replace('/d%/Ums', $show_name, $_LANG['del_check']);
        $dou->dou_msg($_LANG['del_check'], 'show.php', '', '30', "show.php?rec=del&id=$id");
    }
}

?>