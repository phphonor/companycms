<?php
/**
 * DOUCO TEAM
 * ============================================================================
 * COPYRIGHT DOUCO 2014-2015.
 * http://www.douco.com;
 * ----------------------------------------------------------------------------
 * Author:DouCo
 * Release Date: 2014-06-05
 */
if (!defined('IN_DOUCO')) {
    die('Hacking attempt');
}

/* error_reporting */
error_reporting(E_ALL ^ E_NOTICE);
class Install {
    var $sqlcharset;
    function Install($sqlcharset) {
        $this->sqlcharset = $sqlcharset;
    }
    
    /**
     * 数据库导入
     */
    function sql_execute($sql) {
        global $link;
        
        $sqls = $this->sql_split($sql);
        if (is_array($sqls)) {
            foreach ($sqls as $sql) {
                if (trim($sql) != '') {
                    mysql_query($sql, $link);
                }
            }
        } else {
            mysql_query($sqls, $link);
        }
        return true;
    }
    
    /**
     * 数据分离
     */
    function sql_split($sql) {
        global $prefix;
        if ($this->version() > '4.1' && $this->sqlcharset) {
            $sql = preg_replace("/TYPE=(InnoDB|MyISAM)( DEFAULT CHARSET=[^; ]+)?/", "TYPE=\\1 DEFAULT CHARSET=" . $this->sqlcharset, $sql);
        }
        
        $sql = str_replace("\r", "\n", $sql);
        $ret = array ();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num++;
        }
        return ($ret);
    }
    
    /**
     * 返回 MySQL 服务器的信息
     */
    function version() {
        global $link;
        if (empty($this->version)) {
            $this->version = mysql_get_server_info($link);
        }
        return $this->version;
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
     * 判断 文件/目录 是否可写
     */
    function check_writeable($file) {
        if (file_exists($file)) {
            if (is_dir($file)) {
                $dir = $file;
                if ($fp = @fopen("$dir/test.txt", 'w')) {
                    @fclose($fp);
                    @unlink("$dir/test.txt");
                    $writeable = 1;
                } else {
                    $writeable = 0;
                }
            } else {
                if ($fp = @fopen($file, 'a+')) {
                    @fclose($fp);
                    $writeable = 1;
                } else {
                    $writeable = 0;
                }
            }
        } else {
            $writeable = 2;
        }
        
        return $writeable;
    }
}
?>