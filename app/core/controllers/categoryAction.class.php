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
		
		$this->display("listCategory.tpl");
	}
	
	function showCategoryArticle(){
		$this->category=new ArkCategory();
// 		print_r($categories);
		return 	$this->category->getCategory();
	}

}

?>