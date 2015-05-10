<?php

/**
 *
 * 模板解析类
 *
 * @package framework
 * @author Ark
 * 2014-10-11
 */
class Parser {
	//字段，保存模板内容
	private $_tpl;

	//构造方法，用于获取模板文件里的内容
	public function __construct($_tplFile) {
		if (! $this->_tpl = file_get_contents ( $_tplFile )) {
			exit ( 'ERROR：模板文件读取错误！222' );
		}
	}

	//解析普通变量
	private function parVar() {
		$_patten = '/\{\$([\w]+)\}/';
		if (preg_match ( $_patten, $this->_tpl )) {
			$this->_tpl = preg_replace ( $_patten, "<?php echo \$this->_vars['$1'];?>", $this->_tpl );
		}
	}
	
	/**
	 * 解析普通对象
	 * @date: 2015-3-20
	 * @author: Ark <lfzlfz@126.com>
	 * @return: void
	 */
	private function parObject() {
		$_patten = "/\{#([\w]+)\['([\w]+)\']\}/";
		if (preg_match ( $_patten, $this->_tpl )) {
			$this->_tpl = preg_replace ( $_patten, "<?php echo \$this->_vars['$1']->$2;?>", $this->_tpl );
		}
	}
	
	
	//解析if语句
	private function parIf() {
		$_pattenIf = '/\{if\s+\$([\w]+)\}/';
		$_pattenEndIf = '/\{\/if\}/';
		$_pattenElse = '/\{else\}/';
		if (preg_match ( $_pattenIf, $this->_tpl )) {
			if (preg_match ( $_pattenEndIf, $this->_tpl )) {
				$this->_tpl = preg_replace ( $_pattenIf, "<?php if (\$this->_vars['$1']) {?>", $this->_tpl );
				$this->_tpl = preg_replace ( $_pattenEndIf, "<?php } ?>", $this->_tpl );
				if (preg_match ( $_pattenElse, $this->_tpl )) {
					$this->_tpl = preg_replace ( $_pattenElse, "<?php } else { ?>", $this->_tpl );
				}
			} else {
				exit ( 'ERROR：if语句没有关闭！' );
			}
		}
	}
	/**
	 * 解析foreach标签 ，支持二级嵌套
	 * @date: 2014-9-12
	 * @author: Ark <lfzlfz@126.com>
	 * @return: void
	 */
	//解析foreach语句
	private function parForeach() {
		$_pattenForeach = '/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
		$_pattenEndForeach = '/\{\/foreach\}/';
		$_pattenVar = '/\{@([\w]+)\}/';
		$_pattenInnerVar = '/\{foreach\s+\#([\w]+)\(([\w]+),([\w]+)\)\}/';
		$_pattenMemberVar= "/\{@([\w]+\['[\w]+\'])\}/";
		
		if (preg_match ( $_pattenForeach, $this->_tpl )) {
			if (preg_match ( $_pattenEndForeach, $this->_tpl )) {
				$this->_tpl = preg_replace ( $_pattenForeach, "<?php foreach (\$this->_vars['$1'] as \$$2=>\$$3) { ?>", $this->_tpl );
				$this->_tpl = preg_replace ( $_pattenEndForeach, "<?php } ?>", $this->_tpl );
				$this->_tpl = preg_replace ( $_pattenInnerVar, "<?php foreach (\$$1 as \$$2=>\$$3) { ?>", $this->_tpl );
				
				if (preg_match ( $_pattenVar, $this->_tpl )) {
					$this->_tpl = preg_replace ( $_pattenVar, "<?php echo \$$1?>", $this->_tpl );
				}
				//成员变量匹配
				if (preg_match ( $_pattenMemberVar, $this->_tpl )) {
					$this->_tpl = preg_replace ( $_pattenMemberVar, "<?php echo \$$1?>", $this->_tpl );
				}
				
			} else {
				exit ( 'ERROR：foreach语句必须有结尾标签！' );
			}
		}
	}

	//解析include语句 直接载入模板
	/**
	 * 解析<include file='*.tpl'>标签
	 * @date: 2014-9-12
	 * @author: Ark <lfzlfz@126.com>
	 * @return: void
	 */

	private function parInclude() {
		$_patten = '/\{include\s+file=\"([\w\.\-]+)\"\}/';
		while ( preg_match ( $_patten, $this->_tpl, $_file ) ) {
			//echo TPL_DIR.DS.$_file[1];
				

			if (! file_exists ( TPL_DIR . DS . $_file [1] ) || empty ( $_file )) {
				exit ( 'ERROR：Include Tag Parse Wrong！' );
			}
			//app/templates/$1
			/*
			 "<?php include '$1';?>"
			 */
				
			$this->_tpl = preg_replace ( $_patten, file_get_contents ( TPL_DIR . DS . $_file [1] ), $this->_tpl );
		}

	}

	//PHP代码注释
	private function parCommon() {
		$_patten = '/\{#\}(.*)\{#\}/';
		if (preg_match ( $_patten, $this->_tpl )) {
			$this->_tpl = preg_replace ( $_patten, "<?php /* $1 */?>", $this->_tpl );
		}
	}

	//解析系统变量
	private function parConfig() {
		$_patten = '/<!--\{([\w]+)\}-->/';
		if (preg_match ( $_patten, $this->_tpl )) {
			$this->_tpl = preg_replace ( $_patten, "<?php echo \$this->_config['$1'];?>", $this->_tpl );
		}
	} 
	/**
	 * 解析宏变量
	 * @date: 2015-04-28
	 * @author: Ark <lfzlfz@126.com>
	 * @return: void
	 */
	private function parDefine() {
		$_patten = '/<!--\{([\w]+)\}-->/';
		if (preg_match ( $_patten, $this->_tpl )) {
			$this->_tpl = preg_replace ( $_patten, "<?php echo \$this->_config['$1'];?>", $this->_tpl );
		}
	}

	/**
	 * 生成编译文件
	 * @date: 2014-9-12
	 * @author: Ark <lfzlfz@126.com>
	 * @return: void
	 */
	public function compile($_parFile) {
		$logger = SimpleLogger::getInstance ();
		//解析模板内容
		$this->parInclude ();

		//$logger->debug($this->getTpl(),'parInclude');


		$this->parVar ();
		$this->parObject();
		
		$this->parIf ();
		$this->parForeach ();

		$this->parCommon ();
		$this->parConfig ();
		//$logger->debug($this->getTpl(),'Parser.class.php');
		//生成编译文件
		if (! file_put_contents ( $_parFile, $this->_tpl )) {
			exit ( 'ERROR：Generate Complie File Error！' );
		}
	}

}
?>