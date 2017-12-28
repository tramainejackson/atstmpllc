<?php require_once("../include/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php 
	$bankAccount = Bank_Account::find_by_id($_POST["bank_id"]);
	$totalCurrentShare = 0;
	for($i=0; $i < count($_POST["share_pct"]); $i++) {
		$totalCurrentShare = $totalCurrentShare + $_POST["share_pct"][$i];
	}
	
	if($totalCurrentShare > 100) {
		$session->message("<li class='errorItem'>Total percent share cannot total more than 100%</li>");
		redirect_to("bank.php?edit_share=".$bankAccount->bank_account_id);
	} else {
		for($i=0; $i < count($_POST["user_account_id"]); $i++) {
			$userAccount = User_Account::find_by_id($_POST["user_account_id"][$i]);
			$userAccount->id = $_POST["user_account_id"][$i];
			$userAccount->set_share_pct($_POST["share_pct"][$i]);
			$userAccount->set_checking_share($userAccount->get_percent_share() * $bankAccount->get_checking_balance());
			$userAccount->set_savings_share($userAccount->get_percent_share() * $bankAccount->get_savings_balance());

			if($userAccount->save()) {
				$session->message("<li class='okItem'>Changes made to user " . $userAccount->user . "</li>");
			} else {
				$session->message("<li class='errorItem'>No changes made to user " . $userAccount->user . "</li>");
			}
		}
	}

	redirect_to("bank.php?edit_share=".$bankAccount->bank_account_id);
?>
