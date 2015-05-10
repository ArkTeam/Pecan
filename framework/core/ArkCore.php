<?php

/**
* ArkPHP [Fast And Simple]
* ==============================================
* Copyright (c) 2014-2020 http://www.arkphp.com All rights reserved.
* -------------------------------------------------------------------
* Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
* ==============================================
* @date: 2014-9-12 
* @author: Ark <lfzlfz@126.com>
* @version: 0.1.0
*/
error_reporting(0); 

function shutdown_function()  
{  
    $e = error_get_last();    
    print_r($e);  
}

register_shutdown_function('shutdown_function');  


session_start();
require_once (FRAMEWORK_PATH . 'core/autoload.php');
// 'http://' . $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ["SERVER_PORT"] .
//$url = $_SERVER ["REQUEST_URI"];
//artk_autoload ( 'routing' );
//$r = new Router ();
//$r->callHook ();
//这里写了很多自动加载的类库  用__autoload 方法


class ArkPHP {
	
	function __construct() {
		//加载模板库
		artk_autoload ( 'Templates.class' );
		//加载数据库连接器
		artk_autoload ( 'connector.class' );
		//加载数据库配置
		__autoload_conf ( "db_config" );
		//加载ORM类
		artk_autoload ( 'wrapper.class' );
		//加载控制器库
		artk_autoload ( 'controller' );
		//加载模型类
		artk_autoload ( 'model' );
		//加载工具类
		artk_autoload ( 'util' );
		
		//加载所有用户自定义Model类
		$model_list = dir_list ( APP_PATH . 'core/models', 'php' );
		
		artk_autoload_list ( $model_list );
		
		//_autoload('Smarty.class','libs/smarty');
		//加载路由类
		artk_autoload ( 'router' );
		
		//初始化路由
		$router = new Router ();
		$router->route ();
		
		//加载app入口
		require_once APP_PATH . 'index.php';
	}
	
	function start() {
		
		//$logger = SimpleLogger::getInstance();
		//$logger->debug("This is a debug info.");
	}

}

?>