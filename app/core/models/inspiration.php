<?php
class ArkInspiration extends Model {
	
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
	function createInspiration($category_id,$inspiration_content) {
		//		echo $_SESSION['username'];
		//		echo $author;
		//if($author!=$_SESSION['username'])return ;
		
		$posttime = strval(time());
		$artk_inspiration = $this->create (
		array (
 		'author'=> $_SESSION['username'],
	 	'inspiration_content' => $inspiration_content,
	 	'category_id'=>$category_id,
	 	'posttime' => $posttime,
		'updatetime' => $posttime
		) );
		return $this->save ();

	}
	
	function delInspiration ($inspiration_id){
		$this->setID ($inspiration_id);
		return $this->delete();
	}

	function getInspirations($start,$offset){
		$vars = array ();
		$this->limit($start,$offset);
		
		if($this->rowCount()==0){
			return null;
		}
		
		$inspirations = $this->findMany ();
		
		//print_r($inspirations);
		if(!$inspirations){
			//echo 'Error: Find Many Error';
		}
		$rowNames = $this->getRows();
	 
		foreach ( $inspirations as $inspiration ) {
			$var = array ();
			//print_r ( $inspiration );
			foreach ( $rowNames as $row ) {
				//array_push ( $var, $row=>($inspiration->$row));
				 	//print_r ( $row );
				 	$var[$row]=$inspiration->$row;

			}
			
			$var['inspiration_content'] = $this->trimContent($var['inspiration_content']);
			
			$var['posttime']=date('Y-m-d H:i:s', $inspiration->posttime);
			$var['updatetime']=date('Y-m-d H:i:s', $inspiration->updatetime);
			array_push ( $vars, $var);
		}
		return $vars;
	}

	function modifyInspiration($id,$user_id,$title ,$tags,$source,$category_id,$blog_content) {
			
		//if ID存在  && USER_ID有权限操作
		//修改
		
		
	}
	
	function geInspiration($inspiration_id){
		
		return $this->findOne($inspiration_id);
		
	}
	/**
	 * trim content
	 * @param $blog_content
	 */
	function trimContent($content){
		$encoding = 'utf-8';
		$content = strip_tags ( $content );
		$content = preg_replace ( '/\s+|&nbsp;/', '', trim($content) );
		$strwidth = mb_strwidth ( $content, $encoding );
		$width = $strwidth < 200 ? $strwidth : 200;
		$content = mb_strimwidth($content, 0, $width, '....', $encoding);
		return $content;
	}
	

}