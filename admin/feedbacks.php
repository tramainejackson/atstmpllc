<?php require_once("../include/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<!DOCTYPE html>
<html lang="en">
<title>ATSTMPLLC Admin</title>
<meta charset="utf-8">
<meta />
<meta />
<meta />
<meta />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/atstmpllc.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="scripts/atstmpllc.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="scripts/atstmpllc.js"></script>
<!--[if lte IE 9]> <script>window.open("oldBrowser/index.php", "_self");</script> <![endif]-->
<body>
<div id="container">
	<?php $user = User::find_by_id($session->user_id); ?>
	<?php include_once("nav.php"); ?>
	<?php $session->showSessionMessages(); ?>
	<div class="feedback">
		<form name="feedback_form" class="feedbackForm" action="add_feedback.php" method="POST">
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="Were you able to add users?" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="Were you able to create a bank?" />
				<textarea name="answer[]" class=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="Were you able to make a transaction?" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="Did everything work as expected?" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="Did everything flow?" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="Could you see yourself using this website for managing money?" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="Do you think users should be able to remove or edit transactions that have been saved?" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="Did you come across any errors?" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="What do you think would make this better?" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="What questions were you left with after testing this?" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="text" name="question[]" class="questionInput" value="General Feedback" />
				<textarea type="text" name="answer[]" class="" value=""></textarea>
			</div>
			<div class="">
				<input type="submit" name="submit" class="" value="Submit" />
			</div>
		</form>
	</div>
</div>
</body>
</html>