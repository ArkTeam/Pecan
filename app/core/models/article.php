<?php
class ArkArticle extends Model {
	private static $_instance;
	
	function view_name() {
		echo $this->tableName;

	}

	function getCounts(){
		return $this->rowCount();
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
	
	function delArticle ($article_id){
		$this->setID ($article_id);
		return $this->delete();
	}

	function getArticles($start,$offset){
		$vars = array ();
		$this->limit($start,$offset);
		
		if($this->rowCount()==0){
			return null;
		}
		
		$articles = $this->findMany ();
		
		//print_r($articles);
		if(!$articles){
			//echo 'Error: Find Many Error';
		}
		$rowNames = $this->getRows();
	 
		foreach ( $articles as $article ) {
			$var = array ();
			//print_r ( $article );
			foreach ( $rowNames as $row ) {
				//array_push ( $var, $row=>($article->$row));
				 	//print_r ( $row );
				 	$var[$row]=$article->$row;
				 
			}
			//if ($var['d_tag'] == $d_type){
				$var['blog_content']=substr(trim($var['blog_content']),0,200);
				$var['posttime']=date('Y-m-d H:i:s', $article->posttime);
				array_push ( $vars, $var);
				//print_r ( $var );
			//}
		}
		return $vars;
	}

	function modifyArticle($id,$user_id,$title ,$tags,$source,$category_id,$blog_content) {
			
		//if ID存在  && USER_ID有权限操作
		//修改
		
		
	}

	function getArticle($article_id){
		
		return $this->findOne($article_id);
		
	}
	

}