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
		$this->article->where('is_private', '=', '0');
		$this->article->andWhere('d_tag', '=', '0');
		$articles =$this->article->getArticles($s, $o, $s_type);
		$this->tpl_x->assign ( 'articles', $articles );
		$this->display("blog.html");
		
	
	}
	
	function register() {
		
		$this->display ( 'register.tpl' );
	
	}

	//$this->set('product', );


}

?>