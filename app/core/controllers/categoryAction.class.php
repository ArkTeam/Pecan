 <?php


class CategoryAction extends Controller {
	protected $category;
	
	function showCategory(){
		$this->category=new ArkCategory();
// 		$category;// - - 逗我？
		
		$categories=$this->category->getCategory();
		print_r($categories);
		$this->tpl_x->assign( 'categories' , $categories );
		
		$this->display("listCategory.tpl");
	}

}

?>