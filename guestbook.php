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

// 开启SESSION
session_start();

// rec操作项的初始化
$rec = $check->is_letter($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 伪静态url生成
$_URL = $dou->module_url('guestbook', 'insert|del');

/**
 * +----------------------------------------------------------
 * 留言板
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    // 获取分页信息
    $page = $check->is_number($_REQUEST['page']) ? trim($_REQUEST['page']) : 1;
    $limit = $dou->pager('guestbook', $_CFG['display_guestbook'], $page);
    
    // 接收反馈信息
    $post = $_SESSION['post'];
    
    // CSRF防御令牌生成
    $post['token'] = $firewall->set_token('guestbook');
    
    $sql = "SELECT * FROM " . $GLOBALS['dou']->table('guestbook') . "WHERE if_show = '1' ORDER BY id DESC" . $limit;
    $query = $GLOBALS['dou']->query($sql);
    while ($row = $GLOBALS['dou']->fetch_array($query)) {
        $add_time = date("Y-m-d", $row['add_time']);
        
        // 获取管理员回复
        $reply = "SELECT content, add_time FROM " . $dou->table('guestbook') . " WHERE reply_id = '$row[id]'";
        $reply = $dou->fetch_array($dou->query($reply));
        $reply_time = date("Y-m-d", $reply['add_time']);
        
        $guestbook[] = array (
                "id" => $row['id'],
                "title" => $row['title'],
                "name" => $row['name'],
                "content" => $row['content'],
                "add_time" => $add_time,
                "reply" => $reply['content'],
                "reply_time" => $reply_time 
        );
    }
    
    // 初始化回复方式
    $contact_type = array (
            'email',
            'tel',
            'qq' 
    );
    foreach ($contact_type as $value) {
        $selected = ($value == $post['contact_type']) ? ' selected="selected"' : '';
        $option .= "<option value=" . $value . $selected . ">" . $_LANG['guestbook_' . $value] . "</option>";
    }
    
    // 赋值给模板-meta和title信息
    $smarty->assign('page_title', $dou->page_title($_LANG['guestbook']));
    $smarty->assign('keywords', $_CFG['site_keywords']);
    $smarty->assign('description', $_CFG['site_description']);
    
    // 赋值给模板-导航栏
    $smarty->assign('nav_top_list', $dou->get_nav('top'));
    $smarty->assign('nav_middle_list', $dou->get_nav('middle', 0, 'guestbook', 0));
    $smarty->assign('nav_bottom_list', $dou->get_nav('bottom'));
    
    // 赋值给模板-数据
    $smarty->assign('rec', $rec);
    $smarty->assign('insert_url', $_URL['insert']);
    $smarty->assign('option', $option);
    $smarty->assign('wrong', $_SESSION['wrong']);
    $smarty->assign('post', $post);
    $smarty->assign('guestbook', $guestbook);
    $smarty->assign('ur_here', $dou->ur_here('onepage', '', $_LANG['guestbook']));
    
    $smarty->display('guestbook.dwt');
}

/**
 * +----------------------------------------------------------
 * 留言添加
 * +----------------------------------------------------------
 */
if ($rec == 'insert') {
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'guestbook');
    
    // html安全过滤器
    $_POST = $firewall->dou_filter($_POST);
    
    $ip = $dou->get_ip();
    $add_time = time();
    $vcode = $check->is_captcha($_POST['vcode']) ? strtoupper($_POST['vcode']) : '';
    
    // 检查IP是否频繁留言
    if (is_water($ip))
        $dou->dou_msg($_LANG['guestbook_is_water'], $_URL['main']);
        
        // 如果限制必须输入中文则修改错误提示
    $include_chinese = $_CFG['guestbook_check_chinese'] ? $_LANG['guestbook_include_chinese'] : '';
    
    // 验证主题
    if (!$check->guestbook($_POST['title'], 70)) {
        $wrong['title'] = preg_replace('/d%/Ums', $include_chinese, $_LANG['guestbook_title_wrong']);
    }
    
    // 验证联系人
    if (!$check->guestbook($_POST['name'], 30)) {
        $wrong['name'] = preg_replace('/d%/Ums', $include_chinese, $_LANG['guestbook_name_wrong']);
    }
    
    // 验证回复方式
    if (empty($_POST['contact_type'])) {
        $wrong['contact'] = $_LANG['guestbook_contact_type_empty'];
    } elseif (stripos($_POST['contact_type'], 'mail')) {
        if (!$check->is_email($_POST['contact']))
            $wrong['contact'] = $_LANG['guestbook_email_wrong'];
    } else {
        if (!$check->is_number($_POST['contact'])) {
            stripos($_POST['contact_type'], 'qq') ? $wrong['contact'] = $_LANG['guestbook_qq_wrong'] : $wrong['contact'] = $_LANG['guestbook_tel_wrong'];
        }
    }
    
    // 验证留言内容
    if (!$check->guestbook($_POST['content'], 300)) {
        $wrong['content'] = preg_replace('/d%/Ums', $include_chinese, $_LANG['guestbook_content_wrong']);
    }
    
    // 判断验证码
    if ($_CFG['captcha'] && md5($vcode . DOU_SHELL) != $_SESSION['captcha']) {
        $wrong['vcode'] = $_LANG['captcha_wrong'];
    }
    
    if ($wrong) {
        $_SESSION['wrong'] = $wrong;
        $_SESSION['post'] = $_POST;
        
        header('Location: ' . $_URL['main']);
        exit();
    } else {
        $sql = "INSERT INTO " . $dou->table('guestbook') . " (id, title, name, contact_type, contact, content, ip, add_time)" .
                 " VALUES (NULL, '$_POST[title]', '$_POST[name]', '$_POST[contact_type]', '$_POST[contact]', '$_POST[content]', '$ip', '$add_time')";
        $dou->query($sql);
        
        $dou->dou_msg($_LANG['guestbook_insert_success'], $_URL['main']);
    }
}

/**
 * +----------------------------------------------------------
 * 防灌水
 * +----------------------------------------------------------
 */
function is_water($ip) {
    $unread_messages = $GLOBALS['dou']->get_one("SELECT COUNT(*) FROM " . $GLOBALS['dou']->table('guestbook') .
             " WHERE ip = '$ip' AND if_read = 0 AND reply_id = 0");
    
    // 如果管理员未回复的留言数量大于3
    if ($unread_messages >= '3')
        return true;
}

?>