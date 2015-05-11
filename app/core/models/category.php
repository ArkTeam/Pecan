<?php
class ArkCategory extends Model {
	
	function getCategory() {
		$arr=array();
		$categories = $this->findMany ();

// 		foreach ($categories as $category ){
// 			echo '</br>category:'.$category->category_name;
// 		}
		foreach( $categories as $category ){
			
			array_push($arr , $category->category_name);
		}
		if (! $categories) {
			echo 'category is not exits!';
		}
		return $arr;
	}
	
	function getCategoryName() {
		$var = array ();
		$name = $this->getRows ();
		$categories = $this->getCategory ();
// 		print_r($categories);
		foreach ( $categories as $category ) {
			$vars = array ();
			foreach ( $name as $row ) {
				$var [$row] = $category->$row;
			}
			array_push ( $vars, $var );
		}
		
		return $vars;
	}
}

?>