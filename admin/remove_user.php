<?php require_once("../include/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php 
	$remove_user = User::find_by_id($_POST["user_id"]);
	$remove_user->id = $remove_user->user_id;
	
	if($remove_user->delete()) {
		$user_accounts = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id = '".$remove_user->user_id."';");
		foreach($user_accounts as $user_account) {
			$user_account->delete();
		}
		$session->message("<li class='errorItem'>" . $remove_user->full_name() . "has successfully been deleted</li>.");
	}
	
	redirect_to("users.php?edit_user");
?> 
