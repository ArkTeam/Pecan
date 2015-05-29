<?php

//require_once ('app/core/models/user.php');

require_once ('categoryAction.class.php');
class Index extends Controller {
	protected $article;
	protected $category;
	/**
	 * 
	 * @date: 2014-9-12
	 * @author: Ark <lfzlfz@126.com>
	 * @return: null
	 */
	function run($pages=1) {
		$this->setPage ($pages);
		if (! isset ( $s ) || ! isset ( $o )) {
			$s = $_SESSION ['s'];
			$o = $_SESSION ['o'];
			if (! $s) {
				$s = 0;
				$_SESSION ['s'] = $s;
			}
			if (! $o) {
				$o = 10;
				$_SESSION ['o'] = $o;
			}
			// echo 'S:'.$s.'<br/>O:'.$o.'<br/>';
		}
		//show article list
		$this->article = new ArkArticle();
		$this->article->where('is_private', '=', '0');
		$this->article->andWhere('d_tag', '=', '0');
		
		$articles =$this->article->getArticles($s, ROWS);
		$this->tpl_x->assign ( 'articles', $articles );
		
		//show category list
		
		$this->category = new CategoryAction ();
		$categories = $this->category->showCategoryArticle ();
		$this->tpl_x->assign ( 'categories', $categories );
		
		
		$this->article = new ArkArticle();
		$this->article->where('is_private', '=', '0');
		$this->article->andWhere('d_tag', '=', '0');
		$total_articles =  $this->article->getCounts ();
		if($pages!=1){
		$this->tpl_x->assign( 'is_prev', true );
		}else{
		$this->tpl_x->assign( 'is_prev', false );		
		}
		
		
	
		if($pages<(int)(($total_articles+ROWS-1)/ROWS)){
		$this->tpl_x->assign( 'is_next',  true);
		}else{
			$this->tpl_x->assign( 'is_next',  false);
		}
		$this->display("blog.html");
		
	
	}
	//set rows of every page,default 6
	function setPage ( $pages = 1 ,$row =ROWS){
		
		$this->article = new ArkArticle ();
		$start = $row * $pages - $row;
		$_SESSION ['s'] = $start;
		$end = $row;
		$_SESSION ['o'] = $end;
		$this->tpl_x->assign ( 'pages', $pages );
		$arr = $this->article->getCounts ();
		$counts = array ();
		for($i = 1; $i < (($arr)+1) / $row ; $i ++) {
			array_push ( $counts, $i );
		}
		$this->tpl_x->assign( 'porpath',  $_SESSION['porpath']);
		$this->tpl_x->assign ( 'counts', $counts );
	}
	/**
	 * before current page
	 *
	 * @param
	 *        	$pages
	 */
	function nextPage($pages,$row=ROWS) {
		$this->article = new ArkArticle ();
		$arr = $this->article->getCounts ();
		if($pages > $arr/$row){
			$this->run ( $pages);
		}else{
			$this->run ( $pages + 1 );
		}
	
	}
	/**
	 * the next page
	 *
	 * @param
	 *        	$pages
	 */
	function prePage($pages) {
		if ($pages - 1 == 0) {
			$this->run ( 1 );
		}else{
			$this->run ( $pages - 1 );
		}
	
	}
	
	function register() {
		
		$this->display ( 'register.tpl' );
	
	}

	//$this->set('product', );


}

?>