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
class SiteMap {
    var $header = "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n\t<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\">";
    var $footer = "\t</urlset>";
    var $output;
    
    /**
     * +----------------------------------------------------------
     * 构造函数
     * +----------------------------------------------------------
     */
    function SiteMap($domain, $today = '') {
        $this->domain = $domain;
        $this->today = $today;
    }
    
    /**
     * +----------------------------------------------------------
     * 构造站点地图
     * +----------------------------------------------------------
     */
    function build_sitemap() {
        $output = $this->header . "\n\n";
        $output .= $this->read_item();
        $output .= $this->footer;
        return $output;
    }
    
    /**
     * +----------------------------------------------------------
     * 遍历目录将格式转换为sitemap格式
     * +----------------------------------------------------------
     */
    function read_item() {
        $item = $this->array_item();
        
        $arr = "\t\t<url>\n";
        $arr .= "\t\t\t<loc>$this->domain</loc>\n";
        $arr .= "\t\t\t<lastmod>$this->today</lastmod>\n";
        $arr .= "\t\t\t<changefreq>hourly</changefreq>\n";
        $arr .= "\t\t\t<priority>0.9</priority>\n";
        $arr .= "\t\t</url>\n\n";
        
        foreach ($item as $row) {
            $arr .= "\t\t<url>\n";
            $arr .= "\t\t\t<loc>$row[url]</loc>\n";
            $arr .= "\t\t\t<lastmod>$row[date]</lastmod>\n";
            $arr .= "\t\t\t<changefreq>$row[changefreq]</changefreq>\n";
            $arr .= "\t\t\t<priority>0.9</priority>\n";
            $arr .= "\t\t</url>\n\n";
        }
        
        return $arr;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取整站目录数据
     * +----------------------------------------------------------
     */
    function array_item() {
        // 单页面列表
        $page_list = $GLOBALS['dou']->get_page_nolevel();
        foreach ($page_list as $row) {
            $page_array[] = array (
                    "date" => $this->today,
                    "changefreq" => 'weekly',
                    "url" => $row['url'] 
            );
        }
        
        $item_array = $page_array;
        
        // 产品分类列表
        $product_category = $GLOBALS['dou']->get_category_nolevel('product_category');
        $product_category_array[] = array (
                "date" => $this->today,
                "changefreq" => 'hourly',
                "url" => $GLOBALS['dou']->rewrite_url('product_category') 
        );
        foreach ($product_category as $row) {
            $product_category_array[] = array (
                    "date" => $this->today,
                    "changefreq" => 'hourly',
                    "url" => $row['url'] 
            );
        }
        
        $item_array = array_merge($item_array, $product_category_array);
        
        // 产品列表
        $product_list = $GLOBALS['dou']->get_product_list('ALL');
        foreach ($product_list as $row) {
            $product_list_array[] = array (
                    "date" => $row[add_time],
                    "changefreq" => 'weekly',
                    "url" => $row['url'] 
            );
        }
        
        $item_array = array_merge($item_array, $product_list_array);
        
        // 文章分类列表
        $article_category = $GLOBALS['dou']->get_category_nolevel('article_category');
        $article_category_array[] = array (
                "date" => $this->today,
                "changefreq" => 'hourly',
                "url" => $GLOBALS['dou']->rewrite_url('article_category') 
        );
        foreach ($article_category as $row) {
            $article_category_array[] = array (
                    "date" => $this->today,
                    "changefreq" => 'hourly',
                    "url" => $row['url'] 
            );
        }
        
        $item_array = array_merge($item_array, $article_category_array);
        
        // 文章列表
        $article_list = $GLOBALS['dou']->get_article_list('ALL');
        foreach ($article_list as $row) {
            $article_list_array[] = array (
                    "date" => $row[add_time],
                    "changefreq" => 'weekly',
                    "url" => $row['url'] 
            );
        }
        
        $item_array = array_merge($item_array, $article_list_array);
        
        // 其它模块
        $other[] = array (
                "date" => $this->today,
                "changefreq" => 'weekly',
                "url" => $GLOBALS['dou']->rewrite_url('guestbook') 
        );
        $other[] = array (
                "date" => $this->today,
                "changefreq" => 'weekly',
                "url" => $GLOBALS['dou']->rewrite_url('mobile') 
        );
        $other[] = array (
                "date" => $this->today,
                "changefreq" => 'weekly',
                "url" => $GLOBALS['dou']->rewrite_url('user') 
        );
        
        $item_array = array_merge($item_array, $other);
        
        return $item_array;
    }
}
?>