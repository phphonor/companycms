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
class Firewall {
    /**
     * +----------------------------------------------------------
     * 豆壳防火墙
     * +----------------------------------------------------------
     */
    function dou_firewall() {
        // 交互数据转义操作
        $this->dou_magic_quotes();
    }
    
    /**
     * +----------------------------------------------------------
     * 交互数据转义操作
     * +----------------------------------------------------------
     */
    function dou_magic_quotes() {
        if (!@ get_magic_quotes_gpc()) {
            $_GET = $_GET ? $this->addslashes_deep($_GET) : '';
            $_POST = $_POST ? $this->addslashes_deep($_POST) : '';
            $_COOKIE = $this->addslashes_deep($_COOKIE);
            $_REQUEST = $this->addslashes_deep($_REQUEST);
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 递归方式的对变量中的特殊字符进行转义
     * +----------------------------------------------------------
     */
    function addslashes_deep($value) {
        if (empty($value)) {
            return $value;
        }
        
        if (is_array($value)) {
            foreach ((array) $value as $k => $v) {
                unset($value[$k]);
                $k = addslashes($k);
                if (is_array($v)) {
                    $value[$k] = $this->addslashes_deep($v);
                } else {
                    $value[$k] = addslashes($v);
                }
            }
        } else {
            $value = addslashes($value);
        }
        
        return $value;
    }
    
    /**
     * +----------------------------------------------------------
     * 递归方式的对变量中的特殊字符去除转义
     * +----------------------------------------------------------
     */
    function stripslashes_deep($value) {
        if (empty($value)) {
            return $value;
        }
        
        if (is_array($value)) {
            foreach ((array) $value as $k => $v) {
                unset($value[$k]);
                $k = stripslashes($k);
                if (is_array($v)) {
                    $value[$k] = $this->stripslashes_deep($v);
                } else {
                    $value[$k] = stripslashes($v);
                }
            }
        } else {
            $value = stripslashes($value);
        }
        return $value;
    }
    
    /**
     * +----------------------------------------------------------
     * html安全过滤器
     * +----------------------------------------------------------
     */
    function dou_filter($value) {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = htmlspecialchars($v, ENT_NOQUOTES);
            }
        } else {
            // 参数ENT_NOQUOTES代表不转义任何引号，避免与addslashes冲突
            $value = htmlspecialchars($value, ENT_NOQUOTES);
        }
        
        return $value;
    }
    
    /**
     * +----------------------------------------------------------
     * 设置令牌
     * +----------------------------------------------------------
     */
    function set_token($cur) {
        $token = md5(uniqid(rand(), true));
        $n = rand(1, 24);
								return $_SESSION[DOU_ID]['token'][$cur] = substr($token, $n, 8);
    }
    
    /**
     * +----------------------------------------------------------
     * 验证令牌
     * +----------------------------------------------------------
     */
    function check_token($token, $cur) {
        if (isset($_SESSION[DOU_ID]['token'][$cur]) && $token == $_SESSION[DOU_ID]['token'][$cur]) {
            unset($_SESSION[DOU_ID]['token'][$cur]);
            return true;
        } else {
            unset($_SESSION[DOU_ID]['token'][$cur]);
            header('Content-type: text/html; charset=' . DOU_CHARSET);
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">" . $GLOBALS['_LANG']['illegal'];
            exit();
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 获取合法的分类ID或者栏目ID
     * +----------------------------------------------------------
     * $module 模块名称及数据表名
     * $id 分类ID或者栏目ID
     * $unique_id 伪静态别名
     * +----------------------------------------------------------
     */
    function get_legal_id($module, $id = '', $unique_id = '') {
        // 如果设置了id和unique_ie则验证其合法性
        if ((isset($id) && !$GLOBALS['check']->is_number($id)) || (isset($unique_id) && !$GLOBALS['check']->is_unique_id($unique_id)))
            return -1;
        
        if (isset($unique_id)) {
            if ($module == 'page') {
                $get_id = $GLOBALS['dou']->get_one("SELECT id FROM " . $GLOBALS['dou']->table($module) . " WHERE unique_id = '$unique_id'");
            } else {
                if (isset($id)) {
                    $system_unique_id = $GLOBALS['dou']->get_one("SELECT c.unique_id FROM " . $GLOBALS['dou']->table($module . '_category') .
                             " AS c LEFT JOIN " . $GLOBALS['dou']->table($module) . " AS i ON id = '$id' WHERE c.cat_id = i.cat_id");
                    $get_id = $system_unique_id == $unique_id ? $id : '';
                } else {
                    $get_id = $GLOBALS['dou']->get_one("SELECT cat_id FROM " . $GLOBALS['dou']->table($module) . " WHERE unique_id = '$unique_id'");
                }
            }
        } else {
            if (isset($id)) {
                if (strpos($module, 'category')) {
                    $get_id = $GLOBALS['dou']->get_one("SELECT cat_id FROM " . $GLOBALS['dou']->table($module) . " WHERE cat_id = '$id'");
                } else {
                    $get_id = $GLOBALS['dou']->get_one("SELECT id FROM " . $GLOBALS['dou']->table($module) . " WHERE id = '$id'");
                }
            } else {
                // $unique_id和$id都没设置只可能为分类主页或者是详细页没有输入id
                return strpos($module, 'category') ? 0 : -1;
            }
        }
        
        $legal_id = $get_id ? $get_id : -1;
        
        return $legal_id;
    }
}
?>