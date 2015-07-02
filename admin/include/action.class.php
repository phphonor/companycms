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
class Action extends Common {
    /**
     * +----------------------------------------------------------
     * 获取网站信息
     * +----------------------------------------------------------
     */
    function get_config() {
        $query = $this->select_all('config');
        while ($row = $this->fetch_array($query)) {
            $config[$row['name']] = $row['value'];
        }
        return $config;
    }
    
    /**
     * +----------------------------------------------------------
     * 用户权限判断
     * +----------------------------------------------------------
     */
    function admin_check($user_id, $shell, $action_list = ALL) {
        if ($row = $this->admin_state($user_id, $shell)) {
            $this->admin_ontime(10800);
            return $row;
        } else {
            header("Location: " . ROOT_URL . ADMIN_PATH . "/login.php\n");
            exit();
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 用户状态
     * +----------------------------------------------------------
     */
    function admin_state($user_id, $shell) {
        $query = $this->select($this->table('admin'), '*', '`user_id` = \'' . $user_id . '\'');
        $user = $this->fetch_array($query);
        
        // 如果$user则开始比对$shell值
        $check_shell = is_array($user) ? $shell == md5($user['user_name'] . $user['password'] . DOU_SHELL) : FALSE;
        
        // 如果比对$shell吻合，则返回会员信息，否则返回空
        return $check_shell ? $user : NULL;
    }
    
    /**
     * +----------------------------------------------------------
     * 登录超时默认为3小时(10800秒)
     * +----------------------------------------------------------
     */
    function admin_ontime($timeout = '10800') {
        $ontime = $_SESSION[DOU_ID]['ontime'];
        $cur_time = time();
        if ($cur_time - $ontime > $timeout) {
            session_destroy();
        } else {
            $_SESSION[DOU_ID]['ontime'] = time();
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 获取导航菜单
     * +----------------------------------------------------------
     * $type 导航类型
     * $parent_id 默认获取一级导航
     * $level 无限极分类层次
     * $current_id 当前页面栏目ID
     * $mark 无限极分类标记
     * +----------------------------------------------------------
     */
    function get_nav($type = 'middle', $parent_id = 0, $level = 0, $current_id = '', &$nav = array(), $mark = '-') {
        $data = $this->fetch_array_all('nav', 'sort ASC');
        foreach ((array) $data as $value) {
            if ($value['parent_id'] == $parent_id && $value['type'] == $type && $value['id'] != $current_id) {
                if ($value['module'] != 'nav') {
                    $value['guide'] = $this->rewrite_url($value['module'], $value['guide']);
                }
                
                $value['mark'] = str_repeat($mark, $level);
                $nav[] = $value;
                $this->get_nav($type, $value['id'], $level + 1, $current_id, $nav);
            }
        }
        return $nav;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取文章列表
     * +----------------------------------------------------------
     * $cat_id 文章分类ID
     * +----------------------------------------------------------
     */
    function get_article_list($cat_id = '') {
        if ($cat_id) {
            $where = "and a.cat_id = '$cat_id'";
        }
        
        $sql = "SELECT a.id, a.title, a.cat_id, a.add_time, c.cat_name FROM " . $this->table('article') . " AS a, " . $this->table('article_category') .
                 " AS c WHERE a.cat_id = c.cat_id " . $where . "ORDER BY id ASC";
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $add_time = date("Y-m-d", $row['add_time']);
            
            $article_list[] = array (
                    "id" => $row['id'],
                    "cat_id" => $row['cat_id'],
                    "cat_name" => $row['cat_name'],
                    "title" => $row['title'],
                    "add_time" => $add_time 
            );
        }
        
        return $article_list;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取整站目录数据
     * +----------------------------------------------------------
     */
    function get_catalog($module = '', $id = '') {
        // 单页面列表
        $page_list = $this->get_page_nolevel();
        foreach ($page_list as $row) {
            $page_array[] = array (
                    "name" => $row['page_name'],
                    "module" => 'page',
                    "guide" => $row['id'],
                    "cur" => ($module == 'page' && $id == $row['id']) ? true : false,
                    "mark" => '-' . $row['mark'] 
            );
        }
        
        $catalog = $page_array;
        
        // 产品分类列表
        $product_category = $this->get_category_nolevel('product_category');
        $product_category_array[] = array (
                "name" => $GLOBALS['_LANG']['nav_product'],
                "module" => 'product_category',
                "cur" => ($module == 'product_category' && $id == 0) ? true : false,
                "guide" => 0 
        );
        foreach ($product_category as $row) {
            $product_category_array[] = array (
                    "name" => $row['cat_name'],
                    "module" => 'product_category',
                    "guide" => $row['cat_id'],
                    "cur" => ($module == 'product_category' && $id == $row['cat_id']) ? true : false,
                    "mark" => '-' . $row['mark'] 
            );
        }
        
        $catalog = array_merge($catalog, $product_category_array);
        
        // 文章分类列表
        $article_category = $this->get_category_nolevel('article_category');
        $article_category_array[] = array (
                "name" => $GLOBALS['_LANG']['nav_article'],
                "module" => 'article_category',
                "cur" => ($module == 'article_category' && $id == 0) ? true : false,
                "guide" => 0 
        );
        foreach ($article_category as $row) {
            $article_category_array[] = array (
                    "name" => $row['cat_name'],
                    "module" => 'article_category',
                    "guide" => $row['cat_id'],
                    "cur" => ($module == 'article_category' && $id == $row['cat_id']) ? true : false,
                    "mark" => '-' . $row['mark'] 
            );
        }
        
        $catalog = array_merge($catalog, $article_category_array);
        
        // 其它模块
        $other[] = array (
                "name" => $GLOBALS['_LANG']['guestbook'],
                "module" => 'guestbook',
                "cur" => ($module == 'guestbook' && $id == 0) ? true : false,
                "guide" => 0 
        );
        $other[] = array (
                "name" => $GLOBALS['_LANG']['mobile'],
                "module" => 'mobile',
                "cur" => ($module == 'mobile' && $id == 0) ? true : false,
                "guide" => 0 
        );
        
        $catalog = array_merge($catalog, $other);
        
        return $catalog;
    }
    
    /**
     * +----------------------------------------------------------
     * 批量移动分类
     * +----------------------------------------------------------
     * $module 模块名称及数据表名
     * $checkbox 要批量处理的ID合集
     * $new_cate_id 要移动到哪个分类
     * +----------------------------------------------------------
     */
    function category_move($module, $checkbox, $new_cate_id) {
        $sql_in = $this->create_sql_in($_POST['checkbox']);
        
        // 移动分类操作
        $this->query("UPDATE " . $this->table($module) . " SET cat_id = '$new_cate_id' WHERE id " . $sql_in);
        
        $this->create_admin_log($GLOBALS['_LANG']['category_move_batch'] . ': ' . strtoupper($module) . ' ' . addslashes($sql_in));
        $this->dou_msg($GLOBALS['_LANG']['category_move_batch_succes'], $module . '.php');
    }
    
    /**
     * +----------------------------------------------------------
     * 批量删除
     * +----------------------------------------------------------
     */
    function del_all($module, $checkbox) {
        $sql_in = $this->create_sql_in($_POST['checkbox']);
        
        $image_fix = $module == 'product' ? 'product_' : '';
        
        // 删除相应商品图片
        $sql = "SELECT " . $image_fix . "image FROM " . $this->table($module) . " WHERE id " . $sql_in;
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $this->del_image($row[$image_fix . 'image']);
        }
        
        // 删除文章
        $this->query("DELETE FROM " . $this->table($module) . " WHERE id " . $sql_in);
        
        $this->create_admin_log($GLOBALS['_LANG']['del_all'] . ': ' . strtoupper($module) . ' ' . addslashes($sql_in));
        $this->dou_msg($GLOBALS['_LANG']['del_succes'], $module . '.php');
    }
    
    /**
     * +----------------------------------------------------------
     * 删除图片
     * +----------------------------------------------------------
     */
    function del_image($image) {
        $no_ext = explode(".", $image);
        $image_thumb = $no_ext[0] . '_thumb' . '.' . $no_ext[1];
        @unlink(ROOT_PATH . $image);
        @unlink(ROOT_PATH . $image_thumb);
    }
    
    /**
     * +----------------------------------------------------------
     * 获取管理员日志
     * +----------------------------------------------------------
     * $action 管理员操作的内容
     * +----------------------------------------------------------
     */
    function create_admin_log($action) {
        $create_time = time();
        $ip = $this->get_ip();
        
        $sql = "INSERT INTO " . $this->table('admin_log') . " (id, create_time, user_id, action ,ip)" . " VALUES (NULL, '$create_time', " .
                 $_SESSION[DOU_ID]['user_id'] . ", '$action', '$ip')";
        $this->query($sql);
    }
    
    /**
     * +----------------------------------------------------------
     * 获取管理员日志
     * +----------------------------------------------------------
     * $user_id 管理员ID
     * $num 调用日志数量
     * +----------------------------------------------------------
     */
    function get_admin_log($user_id = '', $num = '') {
        if ($user_id) {
            $where = " WHERE user_id = '$user_id'";
        }
        if ($num) {
            $limit = " LIMIT $num";
        }
        
        $sql = "SELECT * FROM " . $this->table('admin_log') . $where . " ORDER BY id DESC" . $limit;
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $create_time = date("Y-m-d", $row[create_time]);
            $user_name = $this->get_one("SELECT user_name FROM " . $this->table('admin') . " WHERE user_id = " . $row['user_id']);
            
            $log_list[] = array (
                    "id" => $row['id'],
                    "create_time" => $create_time,
                    "user_name" => $user_name,
                    "action" => $row['action'],
                    "ip" => $row['ip'] 
            );
        }
        
        return $log_list;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取当前目录子文件夹
     * +----------------------------------------------------------
     * $dir 要检索的目录
     * +----------------------------------------------------------
     */
    function get_subdirs($dir) {
        $subdirs = array ();
        if (!$dh = opendir($dir))
            return $subdirs;
        $i = 0;
        while ($f = readdir($dh)) {
            if ($f == '.' || $f == '..')
                continue;
                // 如果只要子目录名, path = $f;
                // $path = $dir.'/'.$f;
            $path = $f;
            $subdirs[$i] = $path;
            $i++;
        }
        return $subdirs;
    }
    
    /**
     * +----------------------------------------------------------
     * 清除缓存及已编译模板
     * +----------------------------------------------------------
     * $dir 要删除的目录
     * +----------------------------------------------------------
     */
    function dou_clear_cache($dir) {
        $dir = realpath($dir);
        if (!$dir || !@ is_dir($dir))
            return 0;
        $handle = @ opendir($dir);
        if ($dir[strlen($dir) - 1] != DIRECTORY_SEPARATOR)
            $dir .= DIRECTORY_SEPARATOR;
        while ($file = @ readdir($handle)) {
            if ($file != '.' && $file != '..') {
                if (@ is_dir($dir . $file) && !is_link($dir . $file))
                    $this->dou_clear_cache($dir . $file);
                else
                    @ unlink($dir . $file);
            }
        }
        closedir($handle);
    }
    
    /**
     * +----------------------------------------------------------
     * 给URL自动上http://
     * +----------------------------------------------------------
     * $url 网址
     * +----------------------------------------------------------
     */
    function auto_http($url) {
        if (strpos($url, 'http://') !== false || strpos($url, 'https://') !== false) {
            $url = trim($url);
        } else {
            $url = 'http://' . trim($url);
        }
        return $url;
    }
    
    /**
     * +----------------------------------------------------------
     * 版本升级提示
     * +----------------------------------------------------------
     */
    function dou_api() {
        global $_CFG;
        global $sys_info;
        
        $apiget = "ver=$_CFG[douphp_version]&lang=$_CFG[language]&php_ver=$sys_info[php_ver]&mysql_ver=$sys_info[mysql_ver]&os=$sys_info[os]&web_server=$sys_info[web_server]&charset=$sys_info[charset]&template=$_CFG[site_theme]&url=" .
                 ROOT_URL;
        return "http://api.douco.com/update.php" . '?' . $apiget;
    }
    
    /**
     * +----------------------------------------------------------
     * 创建IN查询如"IN('1','2')";
     * +----------------------------------------------------------
     * $arr 要处理成IN查询的数组
     * +----------------------------------------------------------
     */
    function create_sql_in($arr) {
        foreach ((array) $arr as $list) {
            $sql_in .= $sql_in ? ",'$list'" : "'$list'";
        }
        return "IN ($sql_in)";
    }
    
    /**
     * +----------------------------------------------------------
     * 后台通用信息提示
     * +----------------------------------------------------------
     * $text 提示的内容
     * $url 提示后要跳转的网址
     * $out 管理员登录操作时的提示页面
     * $time 多久时间跳转
     * $check 删除确认按钮的链接
     * +----------------------------------------------------------
     */
    function dou_msg($text, $url = '', $out = '', $time = 3, $check = '') {
        if (!$text) {
            $text = $GLOBALS['_LANG']['dou_msg_success'];
        }
        
        $GLOBALS['smarty']->assign('ur_here', $GLOBALS['_LANG']['dou_msg']);
        $GLOBALS['smarty']->assign('text', $text);
        $GLOBALS['smarty']->assign('url', $url);
        $GLOBALS['smarty']->assign('out', $out);
        $GLOBALS['smarty']->assign('time', $time);
        $GLOBALS['smarty']->assign('check', $check);
        
        // 根据跳转时间生成跳转提示
        $cue = preg_replace('/d%/Ums', $time, $GLOBALS['_LANG']['dou_msg_cue']);
        $GLOBALS['smarty']->assign('cue', $cue);
        
        $GLOBALS['smarty']->display('dou_msg.htm');
        exit();
    }
}
?>