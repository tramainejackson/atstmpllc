<?php require_once("../include/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php 
	$current_user = User::find_by_id($session->user_id);
	$edit_user = User::find_by_id($_POST["id"]);
	
	$edit_user->id = $edit_user->user_id;
	$edit_user->set_firstname($_POST["firstname"]);
	$edit_user->set_lastname($_POST["lastname"]);
	$edit_user->set_password($_POST["password"]);
	$edit_user->set_editable($_POST["editable"]);
	$newPicture = isset($_FILES["picture"]) ? $edit_user->checkNewPicture($_FILES["picture"]) : "";
	
	if($newPicture != "" || $newPicture != false) { 
		$edit_user->picture = $newPicture[1];
	}
		
	if($edit_user->save()) {
		if($edit_user->user_id == $session->user_id) {
			$_SESSION["message"] .= "<li class='errorItem'>You updated your own account</li>";
		} else {
			$_SESSION["message"] .= "<li class='okItem'>Changes made to user " . $edit_user->full_name() . "</li>";
		}
	} else {
		$_SESSION["errors"] .= "<li class='errorItem'>No changes made to user " . $edit_user->full_name() . "</li>";
	}
	
	redirect_to("users.php?edit_user");
?>
