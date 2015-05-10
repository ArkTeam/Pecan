<?php

//require_once ('app/core/models/user.php');


require_once ('questionAction.class.php');

class MatchAction extends Controller {
	
	protected $match;
	function __construct() {
		parent::__construct ();
		$this->match = new ArtkMatch ();
	}
	
	function launchMatch($uid, $aid) {
		
		return $this->match->createMatch ( $uid, $aid );
	}
	
	function checkMatch($uid) {
		
		if ($this->match->getMatchByAidAndStatus ( $uid )) {
			echo 1; 
		} else if ($this->match->getMatchByUid ( $uid )) {
			echo 2; //TODO match start 
		} else {
			echo 0;
		}
	
	}
	
	function acceptMatch($uid) {
		$this->match->changeStatus ( $uid );
	}
	
	function submitAnswer($uid, $id, $order, $answer) {
		//TODO
		//echo 'uid:'.$uid.' id:'.trim($id).' answer:'.$answer.' order:'.$order;
		$qs = new QuestionAction ();
		$flag = $qs->isRightAnswer ( $id, $answer );
		if (1) {
			//$flag == 
			//TODO if time right +score
			//echo 'diff'.$this->match->getDiff ( $uid ).'  ';
			$escape = ($this->match->getDiff ( $uid ) - trim ( ($order - 1) ) * 10);
			echo 'escapse' . $escape;
			if ($escape > 0) {
				$this->addScore ( $uid, $order );
			}
			
			echo 1;
		} else {
			echo 0;
		}
	
	}
	function addScore($uid) {
		
		$this->match->modifyScore ( $uid );
	}
}

?>