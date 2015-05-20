<?php
class UtilAction extends Controller {
	function getCaptcha() {
		$_vc = new ValidateCode (); // 瀹炰緥鍖栦竴涓璞�
		$_vc->doimg ();
		$_SESSION ['authnum_session'] = $_vc->getCode (); // 楠岃瘉鐮佷繚瀛樺埌SESSION涓�
	}
	function logout() {
		session_destroy ();
		die ( '<div class="alert"></div>閫�鍑�<script> location.href=\'' . ACTION_URL . '\';</script></div></div>' );
	}
	function wordsplit($content, $num) {
		$content = mb_convert_encoding ( $content, 'GBK', 'auto' );
		// echo $content;
		// $debug = 1;
		$path = APP_PATH . 'thirdlib/wordsplit';
		require_once $path . '/Segment.php';
		$query = new DictQuery ( $path . "/data/coreDict.find" );
		$seg = new Segment ( $query );
		$t1 = microtime ( true );
		$data = $seg->segment ( $content );
		$data = $seg->getKeyword ( $data );
		// var_dump ( microtime ( true ) - $t1 );
		//print_r ( $data );
		$now_cursor = 0;
		$re_str = "";
		foreach ( $data as $key => $value ) {
			if ($now_cursor >= $num) {
				break;
			}
			$now_cursor++;
			$re_str.=$key.';';
		}
		return $content = mb_convert_encoding ( $re_str, 'UTF-8', 'GBK' );;
	}
}
?>