<?php require_once("../include/initialize.php"); ?>
<?php 
	if(!$session->is_logged_in()) { redirect_to("login.php"); }
	if(isset($_POST["submit"])) { 
		$questions = $_POST['question'];
		$answers = $_POST['answer'];
		
		for($i=0; $i < count($questions); $i++) {
			$feedback = new Feedback();
			$feedback->question = $questions[$i];
			$feedback->answer = $answers[$i];
			$feedback->save();
		}
	}
	
	$session->message("<li class='okItem'>Thanks for the feedback</li>");
	redirect_to("index.php");
?>