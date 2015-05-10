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

/**
*  
* 所有系统目录  
*
* @package framework
* @author Ark
* 2014-10-11 
*/
global $autoload_conf;
$autoload_conf['libraries'] = array ();
$autoload_conf['paths'] = array ('core/libs/', 'core/models/', 'core/controllers/', 'core/' ,'core/libs/templatex/','core/libs/orm/');
$autoload_conf['ext-paths'] = array ('core/libs/smarty' );
$autoload_conf['config'] = array ();
$autoload_conf['language'] = array ();
$autoload_conf['model'] = array ();
//print_r($autoload_conf['paths']);
?>