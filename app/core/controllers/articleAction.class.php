<?php

require_once ('categoryAction.class.php');
class ArticleAction extends Controller {

	protected $article;
	
	function test(){
		$this->article = new ArkArticle();
		//$this->article->view_name();
		$this->article->findNext();

	}

	function postArticle($title ,$tags,$source,$category_id,$blog_content){

//		echo $title;
//		echo $tags;
//		echo $blog_content;

		
		$this->article = new ArkArticle();

		$result = $this->article->createArticle($title ,$tags,$source,$category_id,$blog_content);
// 		print_r($result);
		if($result){
			$this->tpl_x->assign ( 'tips', "发表文章成功" );
		}
		else{
			$this->tpl_x->assign ( 'tips', "发表文章失败" );
		}
		$this->display ( 'Info.tpl' );
	}

	function modifyArticle($article_id){


	}
	
	/**
	 * Delete one article
	 * @param: article_id
	 */
	function delArticle($article_id){
		$this->article = new ArkArticle();
		$this->article->getArticle($article_id);
		$this->article->d_tag=1;
		$this->article->save();
		$this->listArticles();
	}
	
	/**
	 * Delete one article
	 * @param: article_id
	 */
	function restoreDelArticle($article_id){
		$this->article = new ArkArticle();
		$this->article->getArticle($article_id);
		$this->article->d_tag=0;
		$this->article->save();
		$this->listArticles();
	}
	
	/**
	 * Hidden one article
	 * @param: article_id
	 */
	function hideArticle($article_id){
		$this->article = new ArkArticle();
		$this->article->getArticle($article_id);
		$this->article->is_private=1;
		$this->article->save();
		$this->listArticles();
	}
	
	/**
	 * Add the hidden article
	 * @param: article_id
	 */
	function addHiddenArticle($article_id){
		$this->article = new ArkArticle();
		$this->article->getArticle($article_id);
		$this->article->is_private=0;
		$this->article->save();
		$this->listArticles();
	}
	
	function showAnArticle($article_id){
		
		$this->article = new ArkArticle();
		$article = $this->article->getArticle($article_id);
		$article->posttime= date('Y-m-d H:i:s', $article->posttime); 
		
		$this->tpl_x->assign('article', $article);
		
		$this->article = new ArkArticle();
		
		$prev_article = $this->article->findPrevOne($article_id);
		 
		//var_dump($prev_article);
		if($prev_article){
			
			$this->tpl_x->assign('prev_article',$prev_article);
			$this->tpl_x->assign('is_prev',true);
		}else{
			$this->tpl_x->assign('is_prev',false);
		}
		
		$this->article = new ArkArticle();
		$next_article = $this->article->findNextOne($article_id);
		
		if($next_article){
			$this->tpl_x->assign('next_article',$next_article);
			$this->tpl_x->assign('is_next',true);
		}else{
			$this->tpl_x->assign('next_article',false);
			$this->tpl_x->assign('is_next',false);
		}
		
		$this->display("viewblog.html");
		
	}
	
	/**
	 * Show to public
	 * @param: integer $s
	 * @param: integer $o
	 */
	function showArticles($s,$o){
		if(!isset($s)||!isset($o)){
			$s=0;
			$o=10;
		}
		$this->article = ArkArticle::getInstance();
		//Public articles
		$this->article->where('is_private','=','0');
		//Not deleted
		$this->article->andWhere('d_tag', '=', '0');
		$articles = $this->article->getArticles($s, $o);
		$this->tpl_x->assign ( 'articles', $articles );
		//print_r($articles);
		$this->display("blog.html");
	}
	
	/**
	 * s_type:
	 * 0 for not deleted
	 * 1 for not deleted and public
	 * 2 for not deleted and private
	 * 3 for deleted
	 * @param: integer $s_type
	 * @param: integer $s
	 * @param: integer $o
	 */
	function listArticles($s_type=0){
		if(!isset($s)||!isset($o)){
			$s=$_SESSION['s'];
			$o=$_SESSION['o'];
// 			echo $s.' '.$o;
		}
		if (!isset($s_type)){
			$s_type = 0;
		}
		$delMode = false;
		$this->article = new ArkArticle();
		if ($s_type >= 4 || $s_type < 0){
			$s_type = 0;
		}
		//echo 'S_TYPE:'.$s_type.'<br/>';
		if ($s_type != 3){
			$this->article->where('d_tag', '=', '0');
			if($s_type == 1){
				$this->article->where('is_private', '=', '0');
				
			}
			else if ($s_type == 2){
				$this->article->where('is_private', '=', '1');
			}
		}
		else if ($s_type == 3){
			$delMode = true;
			$this->article->where('d_tag', '=', '1');
		}
		$articles = $this->article->getArticles($s, $o);
		$this->tpl_x->assign ( 'articles', $articles );
		$this->tpl_x->assign ( 'delmode', $delMode );
		$this->tpl_x->assign ( 'username', $_SESSION['username'] );
		$this->tpl_x->assign( 'porpath', $_SESSION['porpath']);
		//print_r($articles);
		$this->display("listarticle.tpl");
	}
	/**
	 *page for article 
	 * @param  $pages
	 */
	function page($pages=1){
		$this->article=new ArkArticle();
		$start=6*($pages-1);
		$_SESSION['s']=$start;
		$end=6*$pages;
		$_SESSION['o']=$end;
		$this->tpl_x->assign('pages', $pages);
		$arr=$this->article->getCounts();
// 		print_r($arr);
		$counts=array();
		for($i=1;$i<($arr)/6+2;$i++){
			array_push ( $i, $counts);
		}
// 		print_r($counts);
		$this->tpl_x->assign ( 'counts', $counts );
		$this->listArticles($s_type=0);

	}
	/**
	 *	before current page
	 * @param  $pages
	 */
	function nextPage($pages){
		$this->page($pages+1);
	}
	/**
	 *	the next page
	 * @param  $pages
	 */
	function prePage($pages){
		if($pages-1==0){
			$this->page(1);
		}
		$this->page($pages-1);
	}

}

?>
