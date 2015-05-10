<?php

/**
 * ArtkPHP [Fast And Simple]
 * ==============================================
 * Copyright (c) 2014-2020 http://www.cnmpi.com All rights reserved.
 * -------------------------------------------------------------------
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * ==============================================
 * @date: 2014-9-12 
 * @author: Ark <lfzlfz@126.com>
 * @version: 0.1.0
 */

require_once 'auto_conf.php';

/**
 * Auto load the .php class files in directories
 * @param string $className
 */
function artk_autoload($className) {
	global $autoload_conf;
	$temp_path = '';
	foreach ( $autoload_conf ['paths'] as $path ) {
		if (require_it ( $className, gen_path ( $path, $className ) )) {
			return;
		}
	}
	exit ( 'Not Found ' . $className );

}
/**
 * 
 * 自动加载类列表
 * 
 * @author: Ark <lfzlfz@126.com>
 * @return:void
 */
function artk_autoload_list($class_path_list) {
	foreach ( $class_path_list as $path ) {
		if (require_it ( $path, $path )) {
			continue;
		} else {
			exit ( 'Not Found ' . $path );
		}
	}

}
function gen_path($sub_path, $className) {
	
	return FRAMEWORK_PATH . $sub_path . $className . EXT;
}
function require_it($className, $file_path) {
	
	if (file_exists ( $file_path )) {
		require_once ($file_path);
		return true;
	} else {
		return false;
	}
}

function __autoload_conf($className) {
	
	$classpath = FRAMEWORK_PATH . 'config/' . $className . EXT;
	if (file_exists ( $classpath )) {
		require_once ($classpath);
	} else {
		echo 'class file' . $classpath . 'not found!';
	}
}

?>