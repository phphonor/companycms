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
     * 获取导航菜单
     * +----------------------------------------------------------
     * $type 导航类型
     * $parent_id 默认获取一级导航
     * $current_module 当前页面模型名称，用于高亮导航栏
     * $current_id 当前页面栏目ID
     * +----------------------------------------------------------
     */
    function get_nav($type = 'mobile') {
        $sql = "SELECT * FROM " . $this->table('nav') . " WHERE type = '$type' AND parent_id = '0' ORDER BY sort ASC, id ASC";
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $nav[] = array (
                    "nav_name" => $row['nav_name'],
                    "target" => $row['module'] == 'nav' ? true : false,
                    "url" => $row['module'] == 'nav' ? $row['guide'] : $this->rewrite_url($row['module'], $row['guide']) 
            );
        }
        
        return $nav;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取有层次的栏目分类，有几层分类就创建几维数组
     * +----------------------------------------------------------
     * $table 数据表名
     * $parent_id 默认获取一级导航
     * $current_id 当前页面栏目ID
     * +----------------------------------------------------------
     */
    function get_category($table, $parent_id = 0, $current_id = '') {
        $category = array ();
        $data = $this->fetch_array_all($table, 'sort ASC');
        foreach ((array) $data as $value) {
            // $parent_id将在嵌套函数中随之变化
            if ($value['parent_id'] == $parent_id) {
                $value['url'] = $this->rewrite_url($table, $value['cat_id']);
                $value['cur'] = $value['cat_id'] == $current_id ? true : false;
                
                foreach ($data as $child) {
                    // 筛选下级导航
                    if ($child['parent_id'] == $value['cat_id']) {
                        // 嵌套函数获取子分类
                        $value['child'] = $this->get_category($table, $value['cat_id'], $current_id);
                        break;
                    }
                }
                $category[] = $value;
            }
        }
        
        return $category;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取文章列表
     * +----------------------------------------------------------
     * $cat_id 文章分类ID
     * $num 调用文章数量
     * $filter 筛选条件
     * +----------------------------------------------------------
     */
    function get_article_list($cat_id = '', $num = '', $filter = '') {
        $where = $cat_id == 'ALL' ? '' : " WHERE cat_id IN (" . $cat_id . $this->dou_child_id($this->fetch_array_all('article_category'), $cat_id) .
                 ") ";
        $home_sort = ($filter == 'recommend') ? 'home_sort DESC,' : '';
        $limit = $num ? ' LIMIT ' . $num : '';
        
        $sql = "SELECT id, title, content, image, cat_id, add_time, click, description FROM " . $this->table('article') . $where . "ORDER BY " .
                 $home_sort . " id DESC" . $limit;
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $url = $this->rewrite_url('article', $row['id']);
            $add_time = date("Y-m-d", $row['add_time']);
            $add_time_short = date("m-d", $row['add_time']);
            $image = $row['image'] ? ROOT_URL . $row['image'] : '';
            
            // 如果描述不存在则自动从详细介绍中截取
            $description = $row['description'] ? $row['description'] : $this->dou_substr($row['content'], 200);
            
            $article_list[] = array (
                    "id" => $row['id'],
                    "cat_id" => $row['cat_id'],
                    "title" => $row['title'],
                    "image" => $image,
                    "add_time" => $add_time,
                    "add_time_short" => $add_time_short,
                    "click" => $row['click'],
                    "description" => $description,
                    "url" => $url 
            );
        }
        
        return $article_list;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取商品列表
     * +----------------------------------------------------------
     * $cat_id 产品分类ID
     * $num 调用文章数量
     * $filter 筛选条件
     * +----------------------------------------------------------
     */
    function get_product_list($cat_id = '', $num = '', $filter = '') {
        $where = $cat_id == 'ALL' ? '' : " WHERE cat_id IN (" . $cat_id . $this->dou_child_id($this->fetch_array_all('product_category'), $cat_id) .
                 ") ";
        $home_sort = ($filter == 'recommend') ? 'home_sort DESC,' : '';
        $limit = $num ? ' LIMIT ' . $num : '';
        
        $sql = "SELECT id, product_name, price, product_image FROM " . $this->table('product') . $where . "ORDER BY " . $home_sort . " id DESC" .
                 $limit;
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $url = $this->rewrite_url('product', $row['id']);
            $image = explode(".", $row['product_image']);
            $thumb = ROOT_URL . $image[0] . "_thumb." . $image[1];
            $price = $row['price'] > 0 ? $this->price_format($row['price']) : $GLOBALS['_LANG']['price_discuss'];
            
            $product_list[] = array (
                    "id" => $row['id'],
                    "name" => $row['product_name'],
                    "price" => $price,
                    "thumb" => $thumb,
                    "url" => $url 
            );
        }
        
        return $product_list;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取指定分类单页面列表
     * +----------------------------------------------------------
     * $parent_id 调用该ID下的所有单页面，为空时则调用所有
     * $current_id 当前打开的单页面ID，高亮菜单使用
     * +----------------------------------------------------------
     */
    function get_page_list($parent_id = 0, $current_id = '') {
        $page_list = array ();
        $data = $this->fetch_array_all('page', 'id ASC');
        foreach ((array) $data as $value) {
            // $parent_id将在嵌套函数中随之变化
            if ($value['parent_id'] == $parent_id) {
                $value['url'] = $this->rewrite_url('page', $value['id']);
                $value['cur'] = $value['id'] == $current_id ? true : false;
                
                foreach ($data as $child) {
                    // 筛选下级单页面
                    if ($child['parent_id'] == $value['id']) {
                        // 嵌套函数获取子分类
                        $value['child'] = $this->get_page_list($value['id'], $current_id);
                        break;
                    }
                }
                $page_list[] = $value;
            }
        }
        
        return $page_list;
    }
    
    /**
     * +----------------------------------------------------------
     * 页头名称
     * +----------------------------------------------------------
     * $head 页头名称
     * +----------------------------------------------------------
     */
    function head($head) {
        return $head;
    }
    
    /**
     * +----------------------------------------------------------
     * 当前位置
     * +----------------------------------------------------------
     * $module 模块名称
     * $cat_id 分类ID
     * $title 信息标题
     * +----------------------------------------------------------
     */
    function ur_here($module, $cat_id = '') {
        // 模块名称
        $main = "<a href=" . $this->rewrite_url($module) . ">" . $GLOBALS['_LANG'][$module] . "</a>";
        
        // 如果存在分类
        if ($cat_id) {
            $cat_name = $this->get_one("SELECT cat_name FROM " . $this->table($module) . " WHERE cat_id = '" . $cat_id . "'");
            $category = "<b>></b><a href=" . $this->rewrite_url($module, $cat_id) . ">" . $cat_name . "</a>";
        }
        
        $ur_here = $main . $category;
        
        return $ur_here;
    }
    
    /**
     * +----------------------------------------------------------
     * 标题
     * +----------------------------------------------------------
     * $module 模块名称
     * $cat_id 分类ID
     * $title 信息标题
     * +----------------------------------------------------------
     */
    function page_title($title, $module = '', $cat_id = '') {
        // 主栏目
        if ($module) {
            $main = $GLOBALS['_LANG'][$module] . ' | ';
            
            // 如果存在分类
            if ($cat_id) {
                $cat_name = $this->get_one("SELECT cat_name FROM " . $this->table($module) . " WHERE cat_id = '" . $cat_id . "'");
                $category = $cat_name . ' | ';
            }
        }
        
        if ($title)
            $title = $title . ' | ';
        
        $titles = $title . $category . $main;
        $page_title = ($titles ? $titles . $GLOBALS['_CFG']['mobile_name'] : $GLOBALS['_CFG']['mobile_title']) . ' - Powered by DouPHP';
        
        return $page_title;
    }
    
    /**
     * +----------------------------------------------------------
     * 生成在线客服QQ数组
     * +----------------------------------------------------------
     */
    function dou_qq($im) {
        $im_explode = explode(',', $im);
        foreach ($im_explode as $value) {
            if (strpos($value, '/') !== false) {
                $arr = explode('/', $value);
                $list['number'] = $arr['0'];
                $list['nickname'] = $arr['1'];
                $im_list[] = $list;
            } else {
                $im_list[] = $value;
            }
        }
        
        return $im_list;
    }
    
    /**
     * +----------------------------------------------------------
     * 清除html,换行，空格类并且可以截取内容长度
     * +----------------------------------------------------------
     * $str 要处理的内容
     * $length 要保留的长度
     * $charset 要处理的内容的编码，一般情况无需设置
     * +----------------------------------------------------------
     */
    function dou_substr($str, $length, $charset = DOU_CHARSET) {
        $str = trim($str); // 清除字符串两边的空格
        $str = strip_tags($str, ""); // 利用php自带的函数清除html格式
        $str = preg_replace("/\t/", "", $str); // 使用正则表达式匹配需要替换的内容，如：空格，换行，并将替换为空。
        $str = preg_replace("/\r\n/", "", $str);
        $str = preg_replace("/\r/", "", $str);
        $str = preg_replace("/\n/", "", $str);
        $str = preg_replace("/ /", "", $str);
        $str = preg_replace("/&nbsp; /", "", $str); // 匹配html中的空格
        $str = trim($str); // 清除字符串两边的空格
        
        if (function_exists("mb_substr")) {
            $substr = mb_substr($str, 0, $length, $charset);
        } else {
            $c['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $c['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            preg_match_all($c[$charset], $str, $match);
            $substr = join("", array_slice($match[0], 0, $length));
        }
        
        return $substr;
    }
    
    /**
     * +----------------------------------------------------------
     * 信息提示
     * +----------------------------------------------------------
     * $text 提示的内容
     * $url 提示后要跳转的网址
     * $time 多久时间跳转
     * +----------------------------------------------------------
     */
    function dou_msg($text, $url = '', $time = 3) {
        if (!$text) {
            $text = $GLOBALS['_LANG']['dou_msg_success'];
        }
        
        /* 获取meta和title信息 */
        $GLOBALS['smarty']->assign('page_title', $GLOBALS['_CFG']['mobile_title']);
        $GLOBALS['smarty']->assign('keywords', $GLOBALS['_CFG']['mobile_keywords']);
        $GLOBALS['smarty']->assign('description', $GLOBALS['_CFG']['mobile_description']);
        
        /* 初始化导航栏 */
        $data = $this->fetch_array_all('nav', 'sort ASC');
        $GLOBALS['smarty']->assign('nav_top_list', $this->get_nav('top'));
        $GLOBALS['smarty']->assign('nav_middle_list', $this->get_nav('middle'));
        $GLOBALS['smarty']->assign('nav_bottom_list', $this->get_nav('bottom'));
        
        /* 初始化数据 */
        $GLOBALS['smarty']->assign('ur_here', $GLOBALS['_LANG']['dou_msg']);
        $GLOBALS['smarty']->assign('text', $text);
        $GLOBALS['smarty']->assign('url', $url);
        $GLOBALS['smarty']->assign('time', $time);
        
        // 根据跳转时间生成跳转提示
        $cue = preg_replace('/d%/Ums', $time, $GLOBALS['_LANG']['m_dou_msg_cue']);
        $GLOBALS['smarty']->assign('cue', $cue);
        
        $GLOBALS['smarty']->display('dou_msg.dwt');
        
        exit();
    }
}
?>