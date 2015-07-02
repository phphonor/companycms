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
class Common extends DbMysql {
    /**
     * +----------------------------------------------------------
     * 重写 URL 地址
     * +----------------------------------------------------------
     */
    function rewrite_url($module, $value = '') {
        if (is_numeric($value))
            $id = $value;
        else
            $rec = $value;
        
        if ($GLOBALS['_CFG']['rewrite']) {
            $filename = $module != 'page' ? '/' . $id : '';
            $item = (!strpos($module, 'category') && $id) ? $filename . '.html' : '';
            $url = $this->get_unique($module, $id) . $item . ($rec ? '/' . $rec : '');
        } else {
            $req = $rec ? '?rec=' . $rec : ($id ? '?id=' . $id : '');
            $url = $module . '.php' . $req;
        }
        
        if ($module == 'mobile') {
            return ROOT_URL . M_PATH;
        } else {
            // 移动版和PC版的根网址不同
            return (defined('M') ? M_URL : ROOT_URL) . $url;
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 生成模块内所需的链接地址
     * +----------------------------------------------------------
     */
    function module_url($module, $value = '') {
        $url['main'] = $this->rewrite_url($module);
        foreach (explode('|', $value) as $rec) {
            $url[$rec] = $this->rewrite_url($module, $rec);
        }
        
        return $url;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取别名
     * +----------------------------------------------------------
     */
    function get_unique($module, $id) {
        $filed = $module == 'page' ? id : cat_id;
        $table_module = $module;
        
        // 非单页面和分类模型下获取分类ID
        if (!strpos($module, 'category') && $module != 'page') {
            $id = $this->get_one("SELECT cat_id FROM " . $this->table($module) . " WHERE id = " . $id);
            $table_module = $module . '_category';
        }
        
        $unique_id = $this->get_one("SELECT unique_id FROM " . $this->table($table_module) . " WHERE " . $filed . " = " . $id);
        
        // 把分类页和列表的别名统一
        $module = preg_replace("/\_category/", '', $module);
        
        // 伪静态时使用的完整别名
        if ($module == 'page') {
            $unique = $unique_id;
        } elseif ($module == 'article') {
            $unique = $unique_id ? '/' . $unique_id : $unique_id;
            $unique = 'news' . $unique;
        } else {
            $unique = $unique_id ? '/' . $unique_id : $unique_id;
            $unique = $module . $unique;
        }
        
        return $unique;
    }
    
    /**
     * +----------------------------------------------------------
     * 格式化商品价格
     * +----------------------------------------------------------
     */
    function price_format($price = '') {
        $price = number_format($price, $GLOBALS['_CFG']['price_decimal']);
        $price_format = preg_replace('/d%/Ums', $price, $GLOBALS['_LANG']['price_format']);
        
        return $price_format;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取当前分类下所有子分类
     * +----------------------------------------------------------
     */
    function dou_child_id($data, $parent_id = '0') {
        static $child;
        foreach ($data as $value) {
            if ($value['parent_id'] == $parent_id) {
                $child .= ',' . $value['cat_id'];
                $this->dou_child_id($data, $value['cat_id'], $level + 1);
            }
        }
        return $child;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取无层次商品分类，将所有分类存至同一级数组，用$mark作为标记区分
     * +----------------------------------------------------------
     * $table 数据表名
     * $parent_id 默认获取一级导航
     * $level 无限极分类层次
     * $current_id 当前页面栏目ID
     * $category_nolevel 储存分类信息的数组
     * $mark 无限极分类标记
     * +----------------------------------------------------------
     */
    function get_category_nolevel($table, $parent_id = 0, $level = 0, $current_id = '', &$category_nolevel = array(), $mark = '-') {
        $data = $GLOBALS['dou']->fetch_array_all($table, 'sort ASC');
        foreach ((array) $data as $value) {
            if ($value['parent_id'] == $parent_id && $value['cat_id'] != $current_id) {
                $value['url'] = $this->rewrite_url($table, $value['cat_id']);
                $value['mark'] = str_repeat($mark, $level);
                $category_nolevel[] = $value;
                $this->get_category_nolevel($table, $value['cat_id'], $level + 1, $current_id, $category_nolevel);
            }
        }
        
        return $category_nolevel;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取无层次单页面列表
     * +----------------------------------------------------------
     * $parent_id 调用该ID下的所有单页面，为空时则调用所有
     * $level 无限极分类层次
     * $current_id 当前页面栏目ID
     * $mark 无限极分类标记
     * +----------------------------------------------------------
     */
    function get_page_nolevel($parent_id = 0, $level = 0, $current_id = '', &$page_nolevel = array(), $mark = '-') {
        $data = $this->fetch_array_all('page');
        foreach ((array) $data as $value) {
            if ($value['parent_id'] == $parent_id && $value['id'] != $current_id) {
                $value['url'] = $this->rewrite_url('page', $value['id']);
                $value['mark'] = str_repeat($mark, $level);
                $value['level'] = $level;
                $page_nolevel[] = $value;
                $this->get_page_nolevel($value['id'], $level + 1, $current_id, $page_nolevel);
            }
        }
        return $page_nolevel;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取幻灯图片列表
     * +----------------------------------------------------------
     */
    function get_show_list($type = 'pc') {
        if ($type) {
            $where = " WHERE type = '$type'";
        }
        
        $sql = "SELECT * FROM " . $this->table('show') . $where . " ORDER BY sort ASC, id ASC";
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $image = explode('.', basename($row['show_img']));
            $thumb = $GLOBALS['images_dir'] . $GLOBALS['thumb_dir'] . $image['0'] . "_thumb." . $image['1'];
            
            $show_list[] = array (
                    "id" => $row['id'],
                    "show_name" => $row['show_name'],
                    "show_link" => $row['show_link'],
                    "show_img" => ROOT_URL . $row['show_img'],
                    "thumb" => ROOT_URL . $thumb,
                    "sort" => $row['sort'] 
            );
        }
        
        return $show_list;
    }
    
    /**
     * +----------------------------------------------------------
     * 分页
     * +----------------------------------------------------------
     * $table 数据表名
     * $page_size 每页显示数量
     * $page 当前页码
     * $cat_id 分类ID
     * $keyword 搜索页关键词
     * +----------------------------------------------------------
     */
    function pager($table, $page_size = 10, $page, $cat_id = '', $key = '', $keyword = '') {
        // 如果不是网站后台则分页功能会根据伪静态功能开启状态进行调整
        if (!defined('IS_ADMIN'))
            $rewrite = intval($GLOBALS['_CFG']['rewrite']);
        if ($cat_id || $keyword) {
            if ($cat_id && $keyword)
                $and = ' AND ';
            if ($cat_id) {
                // 当前分类下子分类ID
                $child_id = $this->dou_child_id($this->fetch_array_all($table . '_category'), $cat_id);
                
                $where_cat_id = "cat_id IN (" . $cat_id . $child_id . ")";
            }
            if ($keyword)
                $where_keyword = " $key LIKE '%$keyword%'";
            $where = " WHERE " . $where_cat_id . $and . $where_keyword;
        }
        
        if ($table == 'guestbook') {
            $where = " WHERE reply_id = 0";
        }
        
        $sql = "SELECT * FROM " . $this->table($table) . $where;
        $record_count = mysql_num_rows($this->query($sql));
        
        if (defined('IS_ADMIN')) {
            if ($table == 'admin_log') {
                $url = "manager.php?rec=manager_log";
                $get_request = "&page=";
            } else {
                $url = $table . ".php";
                $get_request = $cat_id ? "?id=$cat_id&page=" : "?page=";
            }
        } else {
            if ($keyword) {
                $url = ROOT_URL;
                $search = $keyword ? '&s=' . $keyword : '';
                $get_request = '?p=';
            } else {
                $url = $this->rewrite_url($table . '_category', $cat_id);
                $get_request = $rewrite ? '/o' : ($cat_id ? '&page=' : '?page=');
            }
        }
        
        $page_count = ceil($record_count / $page_size);
        $previous = $url . $get_request . ($page > 1 ? $page - 1 : 0) . $search;
        $next = $url . $get_request . ($page_count > $page ? $page + 1 : 0) . $search;
        $last = $url . $get_request . $page_count . $search;
        
        $pager = array (
                "record_count" => $record_count,
                "page_size" => $page_size,
                "page" => $page,
                "page_count" => $page_count,
                "previous" => $previous,
                "next" => $next,
                "first" => $keyword ? ROOT_URL . '?s=' . $keyword : $url,
                "last" => $last 
        );
        
        $start = ($page - 1) * $page_size;
        $limit = " LIMIT $start, $page_size";
        
        $GLOBALS['smarty']->assign('pager', $pager);
        
        return $limit;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取上一页下一页
     * +----------------------------------------------------------
     */
    function lift($module, $id, $cat_id) {
        $lift['previous'] = $this->fetch_assoc($this->query("SELECT id, title FROM " . $this->table($module) .
                 " WHERE id > $id AND cat_id = $cat_id ORDER BY id ASC"));
        if ($lift['previous'])
            $lift['previous']['url'] = $this->rewrite_url($module, $lift['previous']['id']);
        $lift['next'] = $this->fetch_assoc($this->query("SELECT id, title FROM " . $this->table($module) .
                 " WHERE id < $id AND cat_id = $cat_id ORDER BY id DESC"));
        if ($lift['next'])
            $lift['next']['url'] = $this->rewrite_url($module, $lift['next']['id']);
        
        return $lift;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取真实IP地址
     * +----------------------------------------------------------
     */
    function get_ip() {
        static $ip;
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $ip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            } else {
                $ip = getenv("REMOTE_ADDR");
            }
        }
        
        if (preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/', $ip)) {
            return $ip;
        } else {
            return '127.0.0.1';
        }
    }
}
?>