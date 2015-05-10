<?php

//set_path
define ( 'DS', '/' );

define ( 'DBNAME', 'arkblog' );

define ( 'SITE_NAME', 'ArkBlog' );

define('SITE_URL', 'http://'.$_SERVER['SERVER_NAME'].($_SERVER["SERVER_PORT"]!=80?':'.$_SERVER["SERVER_PORT"]:"").DS.SITE_NAME);


define ( 'IS_WIN', strstr ( PHP_OS, 'WIN' ) ? 1 : 0 );

global $application_name;

$framework_path = 'framework';  //写框架目录

if(!isset($application_name)){
$application_name = 'app';  //这里设置应用目录
}



// The PHP file extension
// this global constant is deprecated.
define ( 'EXT', '.php' );
define ( 'CLASS_EXT', '.class.php' );
define ( 'INC_EXT', '.inc.php' );

define ( 'BASE_PATH', dirname ( __FILE__ ) );


if(!defined("INDEX_PAGE")){
	
define ( 'INDEX_PAGE', 'index.php' );

}
//echo BASE_PATH;
// Path to the framework folder
$framework_path = str_replace ( '\\', DS, BASE_PATH ) . DS . 'framework/';

if (is_dir ( $framework_path )) {
	define ( 'FRAMEWORK_PATH', $framework_path );
} else {
	exit ( 'Your fromework folder path does not appear to be set correctly' );
}


$application_path = str_replace ( '\\', DS, BASE_PATH ) . DS . $application_name . DS;


if (is_dir ( $application_path )) {
	
	define ( 'APP_PATH', $application_path );
	
} else {
	exit ( 'Your application folder path does not appear to be set correctly. ' );
}

define ( 'PUBLIC_PATH', SITE_URL. DS .$application_name . DS . 'public' );
define ( 'ACTION_URL', SITE_URL. DS . INDEX_PAGE );

define ( 'SELF', pathinfo ( __FILE__, PATHINFO_BASENAME ) );

//////////////////////
//define ( 'BASEPATH', str_replace ( "\\", "/", $framework_path ) );
//////////////////


define ( 'TPL_DIR', APP_PATH . 'templates/' );
define ( 'TPL_C_DIR', APP_PATH . 'templates_c/' );
define ( 'CACHE', APP_PATH . 'cache/' );

define ( 'SIMPLE_LOG_ROOT', APP_PATH . 'logs/' );
require_once (FRAMEWORK_PATH . '/core/libs/SimpleLogger.php');

//TODO SET SYSVAR.XML

//echo $_SERVER["REQUEST_METHOD"];
//echo "http://".$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"].'app/public';

define("ACTION_PATH","http://".$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]);
//echo ACTION_PATH;
//echo "http".(0?"s":"")."://".$_SERVER['HTTP_HOST'];

define ( 'MODULE_DIR', APP_PATH . 'core/controllers/' );

//载入ARK框架的主文件

require_once FRAMEWORK_PATH . 'core/ArkCore.php';
?>

