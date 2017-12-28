<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');

class Feedback extends DatabaseObject {
	
	protected static $table_name = "feedback";
	protected static $db_fields=array('question_id', 'question', 'answer');
	
	public $question_id;
	public $question;
	public $answer;
	
	function __construct() {
		
	}
	
}

?>