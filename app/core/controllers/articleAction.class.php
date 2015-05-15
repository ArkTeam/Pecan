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
	
	function showArticles($s,$o){
		if(!isset($s)||!isset($o)){
			$s=0;
			$o=10;
		}
	
		$this->article = ArkArticle::getInstance();
		$articles = $this->article->where('is_private','=','0')->getArticles($s, $o);
		$this->tpl_x->assign ( 'articles', $articles );
		//print_r($articles);
		$this->display("blog.html");
	}
	
	function listArticles($s,$o){
		if(!isset($s)||!isset($o)){
			$s=0;
			$o=10;
		}
		
		$this->article = new ArkArticle();
		$articles = $this->article->where('is_private', '=', '0')->getArticles($s, $o);
		$this->tpl_x->assign ( 'articles', $articles );
		$this->tpl_x->assign ( 'username', $_SESSION['username'] );
		$this->tpl_x->assign( 'porpath', $_SESSION['porpath']);
		//print_r($articles);
		$this->display("listarticle.tpl");
	}
	
	

}

?>
