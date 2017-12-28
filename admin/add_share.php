<?php require_once("../include/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php $user = User::find_by_id($_POST["user_id"]); ?>
<?php $bankAccount = Bank_Account::find_by_id($_POST["bank_id"]); ?>
<?php
	if(isset($_POST["submit"])) {
		$userAccount = new User_Account();
		$userAccount->bank_name = $bankAccount->bank_name;
		$userAccount->bank_account_id = $bankAccount->bank_account_id;
		$userAccount->user_id = $user->user_id;
		$userAccount->user = $user->full_name();
		$userAccount->set_share_pct($_POST["share_pct"]);
		$userAccount->set_company_id($user->get_company_id());
		$userAccount->recreate_shares($userAccount->bank_account_id, $userAccount->get_percent_share());
		$personalTransaction = Bank_Account::find_bank_deposit_withdrawl_diff($bankAccount->bank_account_id);
		$bankAccount->set_checking_balance($bankAccount->get_checking_balance() - $personalTransaction['checkingDiff']);
		$bankAccount->set_savings_balance($bankAccount->get_savings_balance() - $personalTransaction['savingDiff']);

		if($userAccount->save()) {
			$userAccount->set_checking_share($bankAccount->get_checking_balance() * $userAccount->get_percent_share());
			$userAccount->set_savings_share($bankAccount->get_savings_balance() * $userAccount->get_percent_share());
			$userAccount->id = $database->insert_id();
			$userAccount->save();
			$session->message("<li class='okItem'>User account saved successfully</li>");
			redirect_to("bank.php?edit_share=".$bankAccount->bank_account_id);
		}
	}
?>
