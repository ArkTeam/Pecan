<?php

function dir_path($path) {
	$path = str_replace ( '\\', '/', $path );
	if (substr ( $path, - 1 ) != '/')
	$path = $path . '/';
	return $path;
}
/**
 * 列出目录下的所有文件
 *
 * @param str $path 目录
 * @param str $exts 后缀
 * @param array $list 路径数组
 * @return array 返回路径数组
 */
function dir_list($path, $exts = '', $list = array()) {
	$path = dir_path ( $path );

	$files = glob ( $path . '*' );

	foreach ( $files as $v ) {
		if (! $exts || preg_match ( "/\.($exts)/i", $v )) {
			$list [] = $v;
			if (is_dir ( $v )) {
				$list = dir_list ( $v, $exts, $list );
			}
		}
	}
	return $list;
}


function str_to_timestamp($time_now){
	$second =  intval( substr($time_now, 12 , 2 ));
	$minute =  intval( substr($time_now, 10 , 2 ));
	$hour   =  intval( substr($time_now, 8  , 2 ));
	$month  =  intval( substr($time_now, 4  , 2 ));
	$day    =  intval( substr($time_now, 6  , 2 ));
	$year   =  intval( substr($time_now, 0  , 4 ));

	return  mktime( $hour , $minute, $second, $month , $day ,$year);

}
function clean_tpl(){
	
	opendir( TPL_C_DIR ) or die('Open Dir Failed!');
	$files = glob(TPL_C_DIR.'/*');
	foreach ($files as $file) {
		if (is_file($file)) {
			unlink($file);
		} 
	} 
	return  true;
}
function clean_cache($time_now){
	opendir( CACHE ) or die('Open Dir Failed!');
	$files = glob(CACHE.'/*');
	foreach ($files as $file) {
		if (is_file($file)) {
			unlink($file);
		} 
	} 
	return  true;

}
?>