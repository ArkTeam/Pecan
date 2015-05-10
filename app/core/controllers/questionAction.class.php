<?php

//require_once ('app/core/models/user.php');


class QuestionAction extends Controller {
	
	protected $questions;
	function __construct() {
		$this->questions = new ArtkQuestions ();
	}
	function seed() 

	{
		
		list ( $msec, $sec ) = explode ( ' ', microtime () );
		return ( float ) $sec;
	
	}
	function getAnswers() {
		
		srand ( $this->seed () );
		echo rand ( 1, 100 );
		echo $this->questions->getArtkAnswers ( 1 );
	
	}
	function isRightAnswer($id, $answer) {
	 //echo $id;
	// echo $this->questions->getRightAnswer (trim($id));
	 // echo strcmp(trim($answer),trim($this->questions->getRightAnswer ( $id )));
		// echo $answer;
		// echo $this->questions->getRightAnswer(trim($id));
		 return strcmp( trim($answer),trim($this->questions->getRightAnswer ( trim($id) )))==0?1:0;
		
	
	}
	function getTitle() {
		echo $this->questions->getTitle ( 1 );
	}
	
	function getData() {
		srand ( $this->seed () );
		$rid = rand ( 1, 100 );
		//echo $rid;
		echo $rid;
		echo "||";
		echo $this->questions->getTitle ( $rid );
		echo "||";
		echo $this->questions->getArtkAnswers ( $rid );
	}
	function createQuestions() {
		$i = 0;
		for($i = 1; $i < 100; $i ++) {
			echo $this->questions->createQuestion ( "title" + $i, md5 ( "AnswerA"+$i ), md5 ( "AnswerB"+$i+5 ), md5 ( "AnswerC" +$i+2), md5 ( "AnswerD"+$i+1 ), 2 );
		}
	
	}
}

?>