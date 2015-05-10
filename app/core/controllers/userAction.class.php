<?php

//require_once ('app/core/models/user.php');

require_once ('articleAction.class.php');

class UserAction extends Controller {

	protected $user;

	function Login($username, $password) {

		$this->user = new ArkUser ();
		$_name = 'Ark';

		$this->tpl_x->assign ( 'name', $_name );
		$_password = $this->user->getArtkUser ( $username );

		if ($_password == $password && strlen ( $username ) > 0 && strlen ( $password ) > 0) {
			  //$_SESSION['nickname'] = $username;
			  $_SESSION['username'] = $username;
		
			  //echo  'successfully to login!';
		      $_SESSION{'online_id'}= md5($username.$_password);
			$tips = 'successfully to login!';
		} else {
			
			$tips = 'fail to login! ';
		}
		$this->tpl_x->assign ( 'tips', $tips );

		$this->tpl_x->assign ( 'user_id', $this->user->getArtkUserId ( $username ) );
		$this->tpl_x->assign ( 'username', "Ark" );
			
		$this->tpl_x->assign ( 'username', $_SESSION['username'] );
		
		$this->display ( 'index.tpl' );

	}

	function Register($username, $password, $repassword) {
		$this->user = new ArkUser ();
		if ($password != $repassword) {
			return false;
		}
		if ($this->user->createArtkUser ( $username, $password )) {
			$tips = "Register Successfullly";
		} else {
			$tips = "Register Fail";
		}

		$this->tpl_x->assign ( 'tips', $tips );
		$this->display ( 'Info.tpl' );
	}
	
	function Admin(){
	
		 $this->display ( 'login.tpl' );
		
	}
}

?>