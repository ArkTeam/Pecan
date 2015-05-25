<?php
class ArkCategory extends Model {
	
	function getCategoryName() {
		$arr=array();
		$categories = $this->findMany ();

		foreach( $categories as $category ){
			
			array_push($arr , $category->category_name);
		}
		if (! $categories) {
			echo 'category is not exits!';
		}
		return $arr;
	}
	
	function getCategory($start,$offset) {
		$this->limit($start,$offset);
		$arr=array();
		$categories = $this->findMany ();
		$rows = $this->getRows();
		foreach( $categories as $category ){
				$vars=array();
			foreach( $rows as $row){
				$vars[$row]=$category->$row;	
			}
			array_push($arr , $vars);
		}
// 		if (! $categories) {
// 			echo 'category is not exits!';
// 		}
// 		print_r ($arr);
		return $arr;
	}
	
	function createCategory($category_name){
		
		$newCategory=$this->create(array(
				'parent_id'=>0,
				'category_name'=>$category_name
		));
		return $newCategory->save();
	}
	
	function getCounts(){
		return $this->rowCount();
	}
	
	function deleteCategory($category_id){
		$this->setId($category_id);
		$this->delete();
	}

}

?>