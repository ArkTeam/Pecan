<?php
class UtilAction extends Controller {
	function getCaptcha() {
		$_vc = new ValidateCode (); // 实例化一个对象
		$_vc->doimg ();
		$_SESSION ['authnum_session'] = $_vc->getCode (); // 验证码保存到SESSION中
	}
	function logout() {
		session_destroy ();
		die ( '<div class="alert"></div>退出<script> location.href=\''.ACTION_URL.'\';</script></div></div>' );
	}
}
?>