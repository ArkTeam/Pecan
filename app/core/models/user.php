<?php
class ArkUser extends Model {

	function view_name() {
		echo $this->tableName;
	}

	function getArtkUser($username) {
		$this->where ( 'username', '=', $username )->findOne ();
		return $this->password;
	}
	function getArtkUserId($username) {
		$this->where ( 'username', '=', $username )->findOne ();
		return $this->getId();

	}
	function createArtkUser($username ,$password ,$portraitpath) {
		$artk_user = $this->create ( array ('username' => $username,
		 'password' => $password,
		 'portraitpath' =>$portraitpath,
		 'regtime' => strval(time())));
		
		return $this->save ();

	}	
	function getPortraitPath($username){
		$this->where( 'username', '=' , $username)->findOne();
		return $this->portraitpath;
	}
}