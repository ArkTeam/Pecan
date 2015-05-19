 <?php

require_once ('articleAction.class.php');
class CategoryAction extends Controller {
	protected $category;
	
	function showCategory(){
		$this->category=new ArkCategory();
// 		$category;// - - 逗我？
		
		$categories=$this->category->getCategory();
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
	

}

?>