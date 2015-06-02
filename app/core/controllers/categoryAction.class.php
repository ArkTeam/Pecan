 <?php

require_once ('articleAction.class.php');
class CategoryAction extends Controller {
	protected $category;
	protected $artilce;
	function showCategory($pages=1){
		$this->setPage($pages);
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
		$categories=$this->category->getCategory($s, $o);
		//先放这儿，之后改成函数！
		foreach ( $categories as $key => $category ){
			$this->article = new ArkArticle();
			$this->article->where('category_id', '=', $category['id_ark_category']);
			//echo 'CATEGORY_ARTICLE_NO:' . $this->article->getCounts() . '<br/>';
			$artcounts =  $this->article->getCounts();
			$categories[$key] = array_merge ( $category, array("artcounts" => $artcounts) );
		}
// 		print_r($categories);
		$this->tpl_x->assign( 'categories' , $categories );
		$this->tpl_x->assign( 'porpath', $_SESSION['porpath']);
		$this->tpl_x->assign ( 'username', $_SESSION ['username'] );
		$this->display("listCategory.tpl");
	}

	function showCategoryArticle(){
		$this->category=new ArkCategory();
// 		print_r($categories);
		$this->tpl_x->assign( 'porpath',  $_SESSION['porpath']);
		$s=0;
		$o=$this->category->getCounts();
		$categories=$this->category->getCategory($s, $o);
		//add article counts to category list
		foreach ( $categories as $key => $category ){
			$this->article = new ArkArticle();
			$this->article->where('category_id', '=', $category['id_ark_category']);
			//echo 'CATEGORY_ARTICLE_NO:' . $this->article->getCounts() . '<br/>';
			$artcounts =  $this->article->getCounts();
			$categories[$key] = array_merge ( $category, array("artcounts" => $artcounts) );
		}
		return $categories;
	}
	
	function addCategory($category_name){
		$this->category=new ArkCategory();
		$category_name=urldecode($category_name);
		if($category_name == null){
			echo '必须输入分类名称！';
			$this->showCategory($pages=1);
			return ;
		}
		$nameArray=$this->category->getCategoryName();
		foreach( $nameArray as $name){
			if($name == $category_name){
				echo '此分类已经存在！';
				$this->showCategory($pages=1);
				return ;
			}
		}


		$this->category->createCategory($category_name);
		
		$this->showCategory($pages=1);
	}
	
	function add(){
		$this->display('addcategory.tpl');
	}
	
	function del($category_id){
		$this->category=new ArkCategory();
		$this->category->deleteCategory($category_id);
		$this->showCategory($pages=1);
	}
	
	function update($category_id){
		$_SESSION['category_id']=$category_id;
		$this->display('updatecategory.tpl');
	}
	
	function updateCategory($category_name){
		$this->category=new ArkCategory();
		$category_name=urldecode($category_name);
		if($category_name == null){
			echo '必须输入分类名称';
			$this->showCategory($pages=1);
		}
		$this->category->modifyCategory($category_name,$_SESSION['category_id']);
		$this->showCategory($pages=1);
	}
	
	function setPage ( $pages = 1 ,$rows=ROWS){
		if (!$this->category)
			$this->category = new ArkCategory ();
		$start = $rows * $pages - $rows;
		$_SESSION ['s'] = $start;
		$end = $rows;
		$_SESSION ['o'] = $end;
		$this->tpl_x->assign ( 'pages', $pages );
		$arr = $this->category->getCounts ();
		$counts = array ();
		if($arr % $rows == 0){
			$eachpage=$arr / $rows;
		}else{
			$eachpage=$arr / $rows + 1;
		}
		for($i = 1; $i < $eachpage; $i ++) {
			array_push ( $counts, $i );
		}
		//next page & pre page
		$total_categories =  $this->category->getCounts ();
		if($pages!=1){
			$this->tpl_x->assign( 'is_prev', true );
		}else{
			$this->tpl_x->assign( 'is_prev', false );
		}
		
		if($pages<(int)(($total_categories+ROWS-1)/ROWS)){
			$this->tpl_x->assign( 'is_next',  true);
		}else{
			$this->tpl_x->assign( 'is_next',  false);
		}
		$this->tpl_x->assign( 'porpath',  $_SESSION['porpath']);
		$this->tpl_x->assign ( 'counts', $counts );
	}

	

}

?>