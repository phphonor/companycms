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
class Check {
    /**
     * 判断是否为rec操作项
     */
    function is_rec($rec) {
        if (preg_match("/^[a-z_]+$/", $rec)) {
            return true;
        }
    }
    
    /**
     * 判断是否为数字
     */
    function is_number($number) {
        if (preg_match("/^[0-9]*[1-9][0-9]*$/", $number)) {
            return true;
        }
    }
    
    /**
     * 判断是否为字母
     */
    function is_letter($letter) {
        if (preg_match("/^[a-z]+$/", $letter)) {
            return true;
        }
    }
    
    /**
     * 判断用户名是否规范
     */
    function is_username($username) {
        if (preg_match("/^[a-zA-Z]{1}([0-9a-zA-Z]|[._]){3,19}$/", $username)) {
            return true;
        }
    }
    
    /**
     * 判断密码是否规范
     */
    function is_password($password) {
        if (preg_match("/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,22}$/", $password)) {
            return true;
        }
    }
    
    /**
     * 判断验证码是否规范
     */
    function is_captcha($captcha) {
        if (preg_match("/^[A-Za-z0-9]{4}$/", $captcha)) {
            return true;
        }
    }
    
    /**
     * 判断别名是否规范
     */
    function is_unique_id($unique) {
        if (preg_match("/^[a-z0-9-]+$/", $unique)) {
            return true;
        }
    }
    
    /**
     * 判断价格是否规范
     */
    function is_price($price) {
        if (preg_match("/^[0-9.]+$/", $price)) {
            return true;
        }
    }
    
    /**
     * 判断备份文件名是否规范
     */
    function is_backup_file($file_name) {
        if (preg_match("/^[a-zA-Z0-9_]+.sql$/", $file_name)) {
            return true;
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 判断目录是否可写
     * +----------------------------------------------------------
     */
    function is_write($dir) {
        // 判断目录是否存在
        if (file_exists($dir)) {
            // 判断目录是否可写
            if ($fp = @fopen("$dir/test.txt", 'w')) {
                @fclose($fp);
                @unlink("$dir/test.txt");
                $writeable = 1;
            } else {
                $writeable = 0;
            }
        } else {
            $writeable = 2;
        }
        
        return $writeable;
    }
}
?>