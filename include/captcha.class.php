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
class Captcha {
    var $captcha_width = 70; // 文件上传路径 结尾加斜杠
    var $captcha_height = 25; // 缩略图路径（必须在$images_dir下建立） 结尾加斜杠
    
    /**
     * +----------------------------------------------------------
     * 构造函数
     * +----------------------------------------------------------
     */
    function Captcha($captcha_width, $captcha_height) {
        $this->captcha_width = $captcha_width;
        $this->captcha_height = $captcha_height;
    }
    
    /**
     * +----------------------------------------------------------
     * 图片上传的处理函数
     * +----------------------------------------------------------
     */
    function create_captcha() {
        $word = $this->create_word();
        
        // 把验证码字符串写入session
        $_SESSION['captcha'] = md5($word . DOU_SHELL);
        
        // 绘制基本框架
        $im = imagecreatetruecolor($this->captcha_width, $this->captcha_height);
        $bg_color = imagecolorallocate($im, 235, 236, 237);
        imagefilledrectangle($im, 0, 0, $this->captcha_width, $this->captcha_height, $bg_color);
        $border_color = imagecolorallocate($im, 118, 151, 199);
        imagerectangle($im, 0, 0, $this->captcha_width - 1, $this->captcha_height - 1, $border_color);
        
        // 添加干扰
        for($i = 0; $i < 5; $i++) {
            $rand_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imagearc($im, mt_rand(-$this->captcha_width, $this->captcha_width), mt_rand(-$this->captcha_height, $this->captcha_height), mt_rand(30, $this->captcha_width *
                     2), mt_rand(20, $this->captcha_height * 2), mt_rand(0, 360), mt_rand(0, 360), $rand_color);
        }
        for($i = 0; $i < 50; $i++) {
            $rand_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imagesetpixel($im, mt_rand(0, $this->captcha_width), mt_rand(0, $this->captcha_height), $rand_color);
        }
        
        // 生成验证码图片
        $text_color = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
        imagestring($im, 6, 18, 5, $word, $text_color);
        
        // header
        header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
        header("Content-type: image/png;charset=utf-8");
        
        /* 绘图结束 */
        imagepng($im);
        imagedestroy($im);
        
        return true;
    }
    
    /**
     * +----------------------------------------------------------
     * 图片上传的处理函数
     * +----------------------------------------------------------
     */
    function create_word() {
        // 设置随机字符范围
        $chars = "23456789ABCDEFGHJKLMNPQRSTUVWXYZ";
        $word = '';
        for($i = 0; $i < 4; $i++) {
            $word .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        
        return $word;
    }
}
?>