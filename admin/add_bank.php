<?php require_once("../include/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php 
	
	if(isset($_POST["submit"])) {
		$current_user = User::find_by_id($session->user_id);
		$bank = new Bank_Account();
		$bank->set_account_num(isset($_POST["account_num"]) ? $_POST["account_num"] : 0);
		$bank->added_date = date("Y-m-d h:m:s");
		$bank->set_company_id($current_user->get_company_id());
		
		$user_account = new User_Account();
		$user_account->user_id        = $session->user_id;
		$user_account->user           = $bank->added_by   = isset($_POST["added_by"]) ? $_POST["added_by"] : "Incomplete";
		$user_account->bank_name      = $bank->bank_name  = isset($_POST["bank_name"]) ? $_POST["bank_name"] : "";
		$user_account->checking_share = $bank->set_checking_balance(isset($_POST["checking_balance"]) ? round($_POST["checking_balance"], 2) : 0);
		$user_account->savings_share  = $bank->set_savings_balance(isset($_POST["savings_balance"]) ? round($_POST["savings_balance"], 2) : 0);
		$user_account->set_company_id($current_user->get_company_id());
		$dupeName = $bank->bank_name_exist($bank->bank_name, $bank->get_company_id());
		
		if($dupeName == true) {
			$session->message("<li class='errorItem'>Bank Name Already Exist.</li>");
			redirect_to("bank.php?create_bank");
		} else {
			if($bank->save()){
				// Successful
				$user_account->bank_account_id = $db->insert_id();
				$user_account->set_show_bank("Y");
				$user_account->set_edit_bank("Y");
				$user_account->set_share_pct(100);
				if($user_account->save()) {
					$session->message("<li class='okItem'>Saved successfully</li>");
					redirect_to("bank.php");
				} else {
					
				}
			} else {
				
			}
		}
	} else {
		
	}
?>