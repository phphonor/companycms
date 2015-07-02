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
class DbMysql {
    private $dbhost; // 数据库主机
    private $dbuser; // 数据库用户名
    private $dbpass; // 数据库用户名密码
    private $dbname; // 数据库名
    private $dou_link; // 数据库连接标识
    private $prefix; // 数据库前缀
    private $charset; // 数据库编码，GBK,UTF8,gb2312
    private $pconnect; // 持久链接,1为开启,0为关闭
    private $sql; // sql执行语句
    private $result; // 执行query命令的结果资源标识
    private $error_msg; // 数据库错误提示
                        
    // 构造函数
    function DbMysql($dbhost, $dbuser, $dbpass, $dbname = '', $prefix, $charset = 'utf8', $pconnect = 0) {
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbname = $dbname;
        $this->prefix = $prefix;
        $this->charset = strtolower(str_replace('-', '', $charset));
        $this->pconnect = $pconnect;
        $this->connect();
    }
    
    // 数据库连接
    function connect() {
        if ($this->pconnect) {
            if (!$this->dou_link = @mysql_pconnect($this->dbhost, $this->dbuser, $this->dbpass)) {
                $this->error('Can not pconnect to mysql server');
                return false;
            }
        } else {
            if (!$this->dou_link = @mysql_connect($this->dbhost, $this->dbuser, $this->dbpass, true)) {
                $this->error('Can not connect to mysql server');
                return false;
            }
        }
        
        if ($this->version() > '4.1') {
            if ($this->charset) {
                $this->query("SET character_set_connection=" . $this->charset . ", character_set_results=" . $this->charset .
                         ", character_set_client=binary");
            }
            
            if ($this->version() > '5.0.1') {
                $this->query("SET sql_mode=''");
            }
        }
        
        if (mysql_select_db($this->dbname, $this->dou_link) === false) {
            $this->error("NO THIS DBNAME:" . $this->dbname);
            return false;
        }
    }
    
    // 数据库执行语句，可执行查询添加修改删除等任何sql语句
    function query($sql) {
        $this->sql = $sql;
        $query = mysql_query($this->sql, $this->dou_link);
        return $query;
    }
    
    // 取得前一次 MySQL 操作所影响的记录行数
    function affected_rows() {
        return mysql_affected_rows();
    }
    
    // 返回结果集中一个字段的值
    function result($row = 0) {
        return @ mysql_result($this->result, $row);
    }
    
    // 返回结果集中行的数目
    function num_rows($query) {
        return @ mysql_num_rows($query);
    }
    
    // 返回结果集中字段的数
    function num_fields($query) {
        return mysql_num_fields($query);
    }
    
    // 释放结果内存
    function free_result() {
        return mysql_free_result($this->result);
    }
    
    // 返回上一步 INSERT 操作产生的 ID
    function insert_id() {
        return mysql_insert_id();
    }
    
    // 从结果集中取得一行作为数字数组
    function fetch_row($query) {
        return mysql_fetch_row($query);
    }
    
    // 从结果集中取得一行作为关联数组
    function fetch_assoc($query) {
        return mysql_fetch_assoc($query);
    }
    
    // 从结果集取得的行生成的数组
    function fetch_array($query) {
        return mysql_fetch_array($query);
    }
    
    // 返回 MySQL 服务器的信息
    function version() {
        if (empty($this->version)) {
            $this->version = mysql_get_server_info($this->dou_link);
        }
        return $this->version;
    }
    
    // 关闭 MySQL 连接
    function close() {
        return mysql_close($this->dou_link);
    }
    
    // 将指定的表名加上前缀后返回
    function table($str) {
        return '`' . $this->prefix . $str . '`';
    }
    
    // 查询全部
    function select_all($table) {
        return $this->query("SELECT * FROM " . $this->table($table));
    }
    
    // 条件查询
    function select($table, $columnName = "*", $condition = '', $debug = '') {
        $condition = $condition ? ' Where ' . $condition : NULL;
        if ($debug) {
            echo "SELECT $columnName FROM $table $condition";
        } else {
            $query = $this->query("SELECT $columnName FROM $table $condition");
            return $query;
        }
    }
    
    // 删除数据
    function delete($table, $condition, $url = '') {
        if ($this->query("DELETE FROM $table WHERE $condition")) {
            if (!empty($url)) {
                $GLOBALS['dou']->dou_msg($GLOBALS['_LANG']['del_succes'], $url);
            }
        }
    }
    
    // 插入数据
    function fn_insert($table, $column, $value) {
        $this->query("insert into $table ($column) value ($value)");
    }
    
    // 仿真 Adodb 函数
    function get_one($sql, $limited = false) {
        if ($limited == true) {
            $sql = trim($sql . ' LIMIT 1');
        }
        
        $res = $this->query($sql);
        if ($res !== false) {
            $row = mysql_fetch_row($res);
            
            if ($row !== false) {
                return $row[0];
            } else {
                return '';
            }
        } else {
            return false;
        }
    }
    
    // 转义特殊字符
    function escape_string($string) {
        if (PHP_VERSION >= '4.3') {
            return mysql_real_escape_string($string);
        } else {
            return mysql_escape_string($string);
        }
    }
    
    // 循环读取结果集并储存至数组
    function fetch_array_all($table, $order_by = '') {
        $order_by = $order_by ? " ORDER BY " . $order_by : '';
        $query = $this->query("SELECT * FROM " . $this->table($table) . $order_by);
        while ($row = $this->fetch_assoc($query)) {
            $data[] = $row;
        }
        return $data;
    }
    
    // 返回错误信息
    function error($msg = '') {
        $msg = $msg ? "DouPHP Error: $msg" : '<b>MySQL server error report</b><br>' . $this->error_msg;
        exit($msg);
    }
}
?>