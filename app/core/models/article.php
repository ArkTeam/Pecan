<?php
class ArkArticle extends Model {
	private static $_instance;
	
	function view_name() {
		echo $this->tableName;

	}

	public static function getInstance(){
	
		if (self::$_instance===null) {
	
		 self::$_instance=new self();

		}
		return self::$_instance;
	}
	function createArticle($title ,$tags,$source,$category_id,$blog_content) {
		//		echo $_SESSION['username'];
		//		echo $author;
		//if($author!=$_SESSION['username'])return ;

		$artk_article = $this->create (
		array ('title' => $title,
 		'author'=> $_SESSION['username'],
	 	'blog_content' => $blog_content,
	 	'tags'=> $tags,
	 	'source'=>$source,
	 	'category_id'=>$category_id,
	 	'posttime' => strval(time())
		) );
		
		return $this->save ();

	}

	function getArticles($start,$offset){
		$vars = array ();
		$this->limit($start,$offset);
		//$this->where("d_tag", '=', '0');
		$articles = $this->findMany ();
		if(!$articles){
			//echo 'Error: Find Many Error';
		}
		if($this->rowCount()==0){
			return null;
		}
 
		foreach ( $articles as $article ) {
			$var = array ();
			foreach ( $this->getRows() as $row ) {
				//array_push ( $var, $row=>($article->$row));
				 $var[$row]=$article->$row;
			}
			$var['blog_content']=substr(trim($var['blog_content']),0,200);
			$var['posttime']=date('Y-m-d H:i:s', $article->posttime); 
			array_push ( $vars, $var);
		}

		return $vars;
	}

	function modifyArticle($id,$user_id,$title ,$tags,$source,$category_id,$blog_content) {
			
		//if ID存在  && USER_ID有权限曹错
		//修改
		
		
	}

	function getArticle($article_id){
		
		return $this->findOne($article_id);
		
	}

}