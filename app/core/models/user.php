<?php
class ArkUser extends Model {

	function view_name() {
		echo $this->tableName;
	}

	function getArtkUser($user_id) {
		$user = $this->where ( 'id_ark_user', '=', $user_id )->findOne ();
		return $this->findOne($user_id);
	}
    function getArtkPwd($username) {
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
    function updateArkUser($user_id,$email,$phone,$portraitpath){
        $user=$this->findOne($user_id);
        $this->__set( 'email', $email);
        $this->__set( 'phone', $phone);
        $this->__set( 'portraitpath', $portraitpath);
//        echo $email;
//        echo $biography;
        $user->save();

    }
	function getPortraitPath($username){
		$this->where( 'username', '=' , $username)->findOne();
		return $this->portraitpath;
	}
}