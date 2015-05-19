<?php
/**
 * +-----------------------------------------
 * | mysql数据库配置
 * +-----------------------------------------
 */

define ( 'IS_CACHE', false );
OrmConnector::$config = array (
'type' => 'mysql', 
'host' => 'localhost',
'port' => '3306',
'database' => 'arkblog', 
'username' => 'root', 
'password' => '' );
/////////DBNAME

////////////////////////////////////////////////////////////////////
$ark = 'df';
$_config ['dbcharset'] = 'utf8'; // 字符集
$_config ['prefix'] = 'ark_'; // 表名前缀
$_config['version'] = 'ArkPHP 0.1.0';
$_config['action'] = 'index'; //默认方法
$_config['method'] = 'run';
$_config['timezone'] = 'Asia/Hong_Kong'; // 时区 PRC  // 时区设置
$_config['skin'] = 'default';
// COOKIE 设置
$_config['authkey'] = 'justkey '; // 站点密钥