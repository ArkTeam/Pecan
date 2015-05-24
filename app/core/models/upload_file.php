<?php

class ArkUploadFile extends Model{
	function view_name (){
		echo $this->tableName;
	}
	
	function addUploadFile ($filename, $path){
		$this->create ( array (
				'file_name' => $filename,
				'path' => $path,
				'uploadtime' => strval ( time() )
		) );
		$this->save ();
	}
}
?>