 <?php

require_once ('articleAction.class.php');
class CategoryAction extends Controller {
	protected $category;
	protected $artilce;
	function showCategory(){
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
		$this->category=new ArkCategory();
		//$this->getArticleCountsByCate($id_ark_category);
// 		echo '   $id_ark_category:'.$id_ark_category;
		$categories=$this->category->getCategory($s, $o);
		//先放这儿，之后改成函数！
		foreach ( $categories as $key => $category ){
			$this->article = new ArkArticle();
			$this->article->where('category_id', '=', $category['id_ark_category']);
			//echo 'CATEGORY_ARTICLE_NO:' . $this->article->getCounts() . '<br/>';
			$artcounts =  $this->article->getCounts();
			$categories[$key] = array_merge ( $category, array("artcounts" => $artcounts) );
		}
		//print_r($categories);
		$this->tpl_x->assign( 'categories' , $categories );
		$this->tpl_x->assign( 'porpath', $_SESSION['porpath']);
		$this->tpl_x->assign ( 'username', $_SESSION ['username'] );
		$this->display("listCategory.tpl");
	}
	function getArticleCountsByCate($id_ark_category){
		$this->artilce=new ArticleAction();
		//echo '   $id_ark_category:'.$id_ark_category;
		$artcounts=$this->artilce->getArticleCountBycate($id_ark_category);
		$this->tpl_x->assign( 'artcounts',  $artcounts);
		
	}
	function showCategoryArticle(){
		$this->category=new ArkCategory();
// 		print_r($categories);
		$this->tpl_x->assign( 'porpath',  $_SESSION['porpath']);
		return 	$this->category->getCategory();
	}
	
	function addCategory($category_name){
		$this->category=new ArkCategory();
		
		if($category_name == null){
			echo '必须输入分类名称！';
			//$this->display('listCategory.tpl');
			$this->showCategory();
			return ;
		}
		$nameArray=$this->category->getCategoryName();
		foreach( $nameArray as $name){
			if($name == $category_name){
				echo '此分类已经存在！';
				$this->display("addcategory.tpl");
				
			}
		}


		$this->category->createCategory($category_name);
		
		$this->showCategory();
	}
	
	function add(){
		$this->display('addcategory.tpl');
	}
	
	function page($pages = 1) {
		$this->setPage ($pages);
		$this-> showCategory ( );
	}
	
	function setPage ( $pages = 1 ){
		if (!$this->category)
			$this->category = new ArkCategory ();
		$start = 6 * $pages - 6;
		$_SESSION ['s'] = $start;
		$end = 6;
		$_SESSION ['o'] = $end;
		$this->tpl_x->assign ( 'pages', $pages );
		$arr = $this->category->getCounts ();
		$counts = array ();
		for($i = 1; $i < ($arr) / 6 + 1; $i ++) {
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
	function nextPage($pages) {
		$this->category = new ArkCategory ();
		$arr = $this->category->getCounts ();
		if($pages > $arr/6){
			$this->page ( $pages);
		}else{
			$this->page ( $pages + 1 );
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
			$this->page ( 1 );
		}else{
			$this->page ( $pages - 1 );
		}
	
	}
	

}

?>