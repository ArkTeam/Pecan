<?php


class Templatex {

	private $_vars = array ();

	private $_config = array ();


	public function __construct() {
		if(! is_dir ( TPL_C_DIR )){
			mkdir(TPL_C_DIR);
		}
		if (! is_dir ( TPL_DIR )  ) {
			exit ( 'ERROR：Template Dir is Not Exist .' );
		}
	
		$this->loadSysVar();
	}
	
	public function loadSysVar(){
		$this->_config [trim ( "PUBLIC_PATH")] = PUBLIC_PATH;
		
		$this->_config [trim ( "ACTION_URL")]  = ACTION_URL;
		
		$_slf = simplexml_load_file ( FRAMEWORK_PATH . 'config/sys_var.xml' );
		
		$_tagLib = $_slf->xpath ( '/root/sys_tag' );
		
		foreach ( $_tagLib as $_tag ) {
			$this->_config [trim ( $_tag->name )] = $_tag->value;
		}
		
		
	}
	//assign()方法，用于注入变量
	public function assign($_var, $_value) {
		if (isset ( $_var ) && ! empty ( $_var )) {
			//$this->_vars['name']
			$this->_vars [$_var] = $_value;
				
		} else {
			exit ( 'ERROR：PLZ SET TPL VARS' );
		}
	}



	/**
	 * 函数display显示模板内容
	 * 输入文件路径
	 *
	 * @param string 解析文件路径
	 * @return void
	 */
	public function display($_file) {
		 
		$_tplFile = TPL_DIR . $_file;

		 
		if (! file_exists ( $_tplFile )) {
			exit ( 'ERROR :TPL Files Not Found.' );
		}
		 
		$_parFile = TPL_C_DIR . md5 ( $_file ) . $_file . '.php';

		 
		$_cacheFile = CACHE . md5 ( $_file ) . $_file . '.html';
	  
		if (IS_CACHE) {

			if (file_exists ( $_cacheFile ) && file_exists ( $_parFile )) {

				if (filemtime ( $_parFile ) >= filemtime ( $_tplFile ) && filemtime ( $_cacheFile ) >= filemtime ( $_parFile )) {
					//载入缓存文件
					
					include $_cacheFile;
					return;
				}
			}
		}
		
		if (! file_exists ( $_parFile ) || filemtime ( $_parFile ) < filemtime ( $_tplFile )) {
			
			require dirname ( __FILE__ ) . '/Parser.class.php';
			$_parser = new Parser ( $_tplFile ); //模板文件
			$_parser->compile ( $_parFile ); //编译文件
			
		}
		//载入编译文件
		include $_parFile;
		
		if (IS_CACHE) {
			//获取缓冲区内的数据，并且创建缓存文件
			file_put_contents ( $_cacheFile, ob_get_contents () );
			//清除缓冲区(清除了编译文件加载的内容)
			ob_end_clean ();
			//载入缓存文件
			//include $_cacheFile;
		}
	}

}
?>