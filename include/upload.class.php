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
class Upload {
    var $images_dir = "../upload/"; // 文件上传路径 结尾加斜杠
    var $thumb_dir = "thumb/"; // 缩略图路径（必须在$images_dir下建立） 结尾加斜杠
    var $upfile_type = "jpg,gif,png"; // 上传的类型，默认为：jpg gif png rar zip
    var $upfile_size_max = '2048'; // 上传大小限制，单位是“KB”，默认为：1024KB
    var $to_file = true; // $this->to_file设定为false时将以原图文件名创建缩略图
    
    /**
     * +----------------------------------------------------------
     * 构造函数
     * $images_dir 文件上传路径
     * $thumb_dir 缩略图路径
     * +----------------------------------------------------------
     */
    function Upload($images_dir, $thumb_dir) {
        $this->images_dir = $images_dir;
        $this->thumb_dir = $thumb_dir;
    }
    
    /**
     * +----------------------------------------------------------
     * 图片上传的处理函数
     * $upfile 上传的图片域
     * $image_name 给上传的图片重命名
     * +----------------------------------------------------------
     */
    function upload_image($upfile, $image_name = '') {
        if ($GLOBALS['check']->is_write($this->images_dir) != 1) {
            $GLOBALS['dou']->dou_msg($GLOBALS['_LANG']['upload_dir_wrong']);
        }
        
        // 没有命名规则默认以时间作为文件名
        if (empty($image_name)) {
            $image_name = time(); // 设定当前时间为图片名称
        }
        
        if (@ empty($_FILES[$upfile]['name'])) {
            $GLOBALS['dou']->dou_msg($GLOBALS['_LANG']['upload_image_empty']);
        }
        $name = explode(".", $_FILES[$upfile]["name"]); // 将上传前的文件以“.”分开取得文件类型
        $img_count = count($name); // 获得截取的数量
        $img_type = $name[$img_count - 1]; // 取得文件的类型
        if (strpos($this->upfile_type, $img_type) === false) {
            $GLOBALS['dou']->dou_msg($GLOBALS['_LANG']['upload_file_support'] . $this->upfile_type . $GLOBALS['_LANG']['upload_file_support_no'] .
                     $img_type);
        }
        $photo = $image_name . "." . $img_type; // 写入数据库的文件名
        $upfile_name = $this->images_dir . $photo; // 上传后的文件名称
        $upfile_ok = move_uploaded_file($_FILES[$upfile]["tmp_name"], $upfile_name);
        if ($upfile_ok) {
            $img_size = $_FILES[$upfile]["size"];
            $img_size_kb = round($img_size / 1024);
            if ($img_size_kb > ($this->upfile_size_max * 1024)) {
                @unlink($upfile_name);
                $GLOBALS['dou']->dou_msg($GLOBALS['_LANG']['upload_out_size'] . $this->upfile_size_max . "KB");
            }
        } else {
            $GLOBALS['_LANG']['upload_wrong'] = preg_replace('/d%/Ums', $upfile_size_max, $GLOBALS['_LANG']['upload_wrong']);
            $GLOBALS['dou']->dou_msg($GLOBALS['_LANG']['upload_wrong']);
        }
        return $photo;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取上传图片信息
     * $photo 原始图片
     * +----------------------------------------------------------
     */
    function get_img_info($photo) {
        $photo = $this->images_dir . $photo;
        $image_size = getimagesize($photo);
        $img_info["width"] = $image_size[0];
        $img_info["height"] = $image_size[1];
        $img_info["type"] = $image_size[2];
        $img_info["name"] = basename($photo);
        $img_info["ext"] = pathinfo($photo, PATHINFO_EXTENSION);
        return $img_info;
    }
    
    /**
     * +----------------------------------------------------------
     * 创建图片的缩略图
     * $photo 原始图片
     * $width 缩略图宽度
     * $height 缩略图高度
     * $quality 生成缩略图片质量
     * +----------------------------------------------------------
     */
    function make_thumb($photo, $width = '128', $height = '128', $quality = '80') {
        $img_info = $this->get_img_info($photo);
        $photo = $this->images_dir . $photo; // 获得图片源
        $thumb_name = substr($img_info["name"], 0, strrpos($img_info["name"], ".")) . "_thumb." . $img_info["ext"]; // 缩略图名称
        if ($img_info["type"] == 1) {
            $img = imagecreatefromgif($photo);
        } elseif ($img_info["type"] == 2) {
            $img = imagecreatefromjpeg($photo);
        } elseif ($img_info["type"] == 3) {
            $img = imagecreatefrompng($photo);
        } else {
            $img = "";
        }
        
        if (empty($img)) {
            return False;
        }
        
        $width = ($width > $img_info["width"]) ? $img_info["width"] : $width;
        $height = ($height > $img_info["height"]) ? $img_info["height"] : $height;
        $thumb_width = $img_info["width"];
        $thumb_height = $img_info["height"];
        if ($thumb_width * $width > $thumb_height * $height) {
            $height = round($thumb_height * $width / $thumb_width);
        } else {
            $width = round($thumb_width * $height / $thumb_height);
        }
        if (function_exists("imagecreatetruecolor")) {
            $new_thumb = imagecreatetruecolor($width, $height);
            ImageCopyResampled($new_thumb, $img, 0, 0, 0, 0, $width, $height, $img_info["width"], $img_info["height"]);
        } else {
            $new_thumb = imagecreate($width, $height);
            ImageCopyResized($new_thumb, $img, 0, 0, 0, 0, $width, $height, $img_info["width"], $img_info["height"]);
        }
        
        // $this->to_file设定为false时将以原图文件名创建缩略图
        if ($this->to_file) {
            if (file_exists($this->images_dir . $this->thumb_dir . $thumb_name))
                @ unlink($this->images_dir . $this->thumb_dir . $thumb_name);
            ImageJPEG($new_thumb, $this->images_dir . $this->thumb_dir . $thumb_name, $quality);
            return $this->images_dir . $this->thumb_dir . $thumb_name;
        } else {
            ImageJPEG($new_thumb, '', $quality);
        }
        ImageDestroy($new_thumb);
        ImageDestroy($img);
        return $thumb_name;
    }
}
?>