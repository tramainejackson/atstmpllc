<?php require_once("../include/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php 
	if(isset($_POST["submit"])) { 
		$current_user = User::find_by_id($session->user_id);
		$newUser = new User();
		$newUser->id        = isset($_POST["id"]) ? $_POST["id"] : null;
		$newUser->username  = isset($_POST["username"]) ? $_POST["username"] : "";
		$newUser->password  = isset($_POST["password"]) ? $_POST["password"] : "";
		$newUser->firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
		$newUser->lastname  = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
		$newUser->picture = isset($_FILES["picture"]) ? $newUser->checkNewPicture($_FILES["picture"]) : "";
		$newUser->set_editable(isset($_POST["editable"]) ? $_POST["editable"] : "");
		$newUser->set_company_id($current_user->get_company_id());

		if($newUser->picture != "" || $newUser->picture != false) {
			$newUser->set_picture($newUser->picture[1]);
		}
		if($newUser->save()) {
			$session->message("<li class='okItem'>User Saved Successfully</li>");
		} else {
			$session->message("<li class='errorItem'>Unable to add user.</li>.");
		}
	}
	
	redirect_to("users.php");
?>