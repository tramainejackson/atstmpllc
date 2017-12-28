<?php require_once("../include/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// echo"<pre>";
	// print_r($_POST);
	// echo"</pre>";
	
	$bankAccount = Bank_Account::find_by_id($_POST["bank_id"]);
	$bankAccount->id = $bankAccount->bank_account_id;
	$bankAccount->bank_name = $_POST["bank_name"];
	$bankAccount->set_checking_balance(round($_POST["checking_balance"], 2));
	$bankAccount->set_savings_balance(round($_POST["savings_balance"], 2));
	$bankAccount->recreate_shares();

	if($bankAccount->save()) {
		$session->message("<li class='okItem'>Bank information saved</li>");
	} else {
		$session->message("<li class='errorItem'>No changes made to the bank information</li>");
	}
	
	if(isset($_POST["user_account_id"])) {
		for($i=0; $i < count($_POST["user_account_id"]); $i++) {
			$userAccount = User_Account::find_by_id($_POST["user_account_id"][$i]);
			$userAccount->id = $_POST["user_account_id"][$i];
			$userAccount->set_show_bank($_POST["show_bank"][$i]);
			$userAccount->set_edit_bank($_POST["edit_bank"][$i]);		

			if($userAccount->save()) {
				$session->message("<li class='okItem'>Changes made to user " . $userAccount->user . "</li>");
			} else {
				$session->message("<li class='errorItem'>No changes made to user " . $userAccount->user . "</li>");
			}
		}
	}
	
	
	// echo($_SESSION['message']);
	redirect_to("bank.php");
?>
