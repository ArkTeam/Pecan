<?php

/**
 *
 * 控制器类
 *
 * @package framework
 * @author Ark
 * 2014-10-11
 */
class Controller {

	private static $instance;
	protected $tpl_x;
	/**
	 * Constructor
	 */
	public function __construct() {
		self::$instance = & $this;

		$this->tpl_x = new Templatex ();
		
		SimpleLogger::debug ( "Controller class is initailized" );
	
	}

	function display($tpl) {

		$this->tpl_x->display ( $tpl );
	}
	public static function &get_instance() {
		return self::$instance;
	}
}
?>