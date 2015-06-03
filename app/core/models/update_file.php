<?php

class ArkUpdateFile extends Model{
	function view_name (){
		echo $this->tableName;
	}
	
	function addUpdateFile ($filename, $path){
		$this->create ( array (
				'file_name' => $filename,
				'path' => $path,
				'uploadtime' => strval ( time() )
		) );
		$this->save ();
	}
}
?>