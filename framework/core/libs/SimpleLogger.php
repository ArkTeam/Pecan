<?php

if (! defined ( 'SIMPLE_LOG_ROOT' )) {
	define ( 'SIMPLE_LOG_ROOT', '/logs/' );
}

define ( 'LEVEL_FATAL', 0 );
define ( 'LEVEL_ERROR', 1 );
define ( 'LEVEL_WARN', 2 );
define ( 'LEVEL_INFO', 3 );
define ( 'LEVEL_DEBUG', 4 );

class SimpleLogger {
	
	static $LOG_LEVEL_NAMES = array ('FATAL', 'ERROR', 'WARN', 'INFO', 'DEBUG' );
	
	private $level = LEVEL_DEBUG;
	
	static function getInstance() {
		return new SimpleLogger ();
	}
	
	function setLogLevel($lvl) {
		if ($lvl >= count ( SimpleLogger::$LOG_LEVEL_NAMES ) || $lvl < 0) {
			throw new Exception ( 'invalid log level:' . $lvl );
		}
		$this->level = $lvl;
	}
	
	static function _log($level, $message, $name) {
		if ($level > $this->level) {
			return;
		}
		
		$log_file_path = SIMPLE_LOG_ROOT . 'artk_php.log';
		$log_level_name = SimpleLogger::$LOG_LEVEL_NAMES [$this->level];
		$content = date ( 'Y/m/d H:i:s' ) . '  [' . $log_level_name . '] [ ' . $name . ' ] ' . $message . "\n";
		//echo $content;
		file_put_contents ( $log_file_path, $content, FILE_APPEND );
	}
	static function debug($message, $name = 'root') {
		$switch = false;
		date_default_timezone_set ( 'Asia/Shanghai' );
		if ($switch) {
			$log_file_path = SIMPLE_LOG_ROOT . 'artk_php.log';
			$content = date ( 'Y/m/d H:i:s' ) . '  [ debug ] [ ' . $name . ' ] ' . $message . "\n";
			file_put_contents ( $log_file_path, $content, FILE_APPEND );
		}
	}
	static function warn($message, $name = 'root') {
		$switch = false;
		date_default_timezone_set ( 'Asia/Shanghai' );
		if ($switch) {
			$log_file_path = SIMPLE_LOG_ROOT . 'ark_php.log';
			$content = date ( 'Y/m/d H:i:s' ) . '  [ debug ] [ ' . $name . ' ] ' . $message . "\n";
			file_put_contents ( $log_file_path, $content, FILE_APPEND );
		}
	}
	static function fatal($message, $name = 'root') {
		$switch = false;
		date_default_timezone_set ( 'Asia/Shanghai' );
		if ($switch) {
			$log_file_path = SIMPLE_LOG_ROOT . 'artk_php.log';
			$content = date ( 'Y/m/d H:i:s' ) . '  [ debug ] [ ' . $name . ' ] ' . $message . "\n";
			file_put_contents ( $log_file_path, $content, FILE_APPEND );
		}
	}
	function _debug($message, $name = 'root') {
		$this->_log ( LEVEL_DEBUG, $message, $name );
	}
	function info($message, $name = 'root') {
		$this->_log ( LEVEL_INFO, $message, $name );
	}
	function _warn($message, $name = 'root') {
		$this->_log ( LEVEL_WARN, $message, $name );
	}
	function error($message, $name = 'root') {
		$this->_log ( LEVEL_ERROR, $message, $name );
	}
	function _fatal($message, $name = 'root') {
		$this->_log ( LEVEL_FATAL, $message, $name );
	}
}

