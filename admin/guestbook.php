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
if (empty($_REQUEST['rec'])) {
    $_REQUEST['rec'] = 'default';
} else {
    $_REQUEST['rec'] = trim($_REQUEST['rec']);
}

$smarty->assign('rec', $_REQUEST['rec']);
$smarty->assign('cur', 'guestbook');

/**
 * +----------------------------------------------------------
 * 留言列表
 * +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'default') {
    $smarty->assign('ur_here', $_LANG['guestbook']);
    
    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager('guestbook', 15, $page);
    
    $sql = "SELECT id, title, name, contact_type, contact, if_show, if_read, ip, add_time FROM " . $dou->table('guestbook') .
             " WHERE reply_id = '0'  ORDER BY id DESC" . $limit;
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $if_show = $row['if_show'] ? $_LANG['display'] : $_LANG['hidden'];
        $add_time = date("Y-m-d", $row[add_time]);
        
        $book_list[] = array (
                "id" => $row['id'],
                "title" => $row['title'],
                "name" => $row['name'],
                "contact_type" => $row['contact_type'],
                "contact" => $row['contact'],
                "if_show" => $if_show,
                "if_read" => $row['if_read'],
                "ip" => $row['ip'],
                "add_time" => $add_time 
        );
    }
    
    $smarty->assign('book_list', $book_list);
    $smarty->display('guestbook.htm');
} 

/**
 * +----------------------------------------------------------
 * 留言查看
 * +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'read') {
    $smarty->assign('ur_here', $_LANG['guestbook_read']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['guestbook_list'],
            'href' => 'guestbook.php' 
    ));
    
    $id = trim($_REQUEST['id']);
    
    // 获取留言信息
    $query = $dou->select($dou->table(guestbook), '*', '`id` = \'' . $id . '\'');
    $guestbook = $dou->fetch_array($query);
    $guestbook['add_time'] = date("Y-m-d", $guestbook['add_time']);
    
    // 获取管理员回复
    $sql = "SELECT content, add_time FROM " . $dou->table('guestbook') . " WHERE reply_id = '$id'";
    $query = $dou->query($sql);
    $reply = $dou->fetch_array($query);
    $reply['add_time'] = date("Y-m-d", $reply['add_time']);
    
    // 将留言信息更新为已读
    $read = "UPDATE " . $dou->table('guestbook') . " SET if_read = '1' WHERE id = '$id'";
    $dou->query($read);
    
    $smarty->assign('guestbook', $guestbook);
    $smarty->assign('reply', $reply);
    $smarty->display('guestbook.htm');
} 

/**
 * +----------------------------------------------------------
 * 留言回复
 * +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'reply') {
    $name = time();
    $ip = $dou->get_ip();
    $add_time = time();
    
    $sql = "INSERT INTO " . $dou->table('guestbook') . " (id, name, content, ip, add_time, reply_id)" .
             " VALUES (NULL, '$_USER[user_name]', '$_POST[content]', '$ip', '$add_time', '$_POST[id]')";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['guestbook_reply'] . ': ' . $_POST[title]);
    
    $dou->dou_msg($_LANG['guestbook_insert_success'], 'guestbook.php');
} 

/**
 * +----------------------------------------------------------
 * 显示或隐藏
 * +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'show_hidden') {
    $id = trim($_REQUEST['id']);
    $if_show = $dou->get_one("SELECT if_show FROM " . $dou->table('guestbook') . " WHERE id = '$id'");
    $if_show = $if_show ? 0 : 1;
    
    // 更新留言信息显示状态
    $read = "UPDATE " . $dou->table('guestbook') . " SET if_show = '$if_show' WHERE id = '$id'";
    $dou->query($read);
    
    echo "<em class=" . ($if_show ? 'd' : 'h') . "><b>$_LANG[display]</b><s>$_LANG[hidden]</s></em>";
} 

/**
 * +----------------------------------------------------------
 * 批量留言删除
 * +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'del_all') {
    if (is_array($_POST['checkbox'])) {
        $checkbox = $dou->create_sql_in($_POST['checkbox']);
        
        // 删除留言
        $sql = "DELETE FROM " . $dou->table('guestbook') . " WHERE id " . $checkbox;
        $dou->query($sql);
        
        $dou->create_admin_log($_LANG['guestbook_del'] . ": GUESTBOOK " . addslashes($checkbox));
        $dou->dou_msg($_LANG['del_succes'], 'guestbook.php');
    } else {
        $dou->dou_msg($_LANG['guestbook_select_empty'], 'guestbook.php');
    }
}
?>