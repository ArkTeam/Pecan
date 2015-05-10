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
	function createArtkUser($username ,$password) {
		$artk_user = $this->create ( array ('username' => $username,
		 'password' => $password,
		 'regtime' => strval(time())));
		
		return $this->save ();

	}
}