<?php

//require_once ('app/core/models/user.php');


class Index extends Controller {
	protected $article;
	/**
	 * 
	 * @date: 2014-9-12
	 * @author: Ark <lfzlfz@126.com>
	 * @return: null
	 */
	function run() {

		$s=0;
		$o=10;
		$this->article = new ArkArticle();
		$articles =$this->article->getArticles($s, $o);
		$this->tpl_x->assign ( 'articles', $articles );
		$this->display("blog.html");
		
	
	}
	
	function register() {
		
		$this->display ( 'register.tpl' );
	
	}

	//$this->set('product', );


}

?>