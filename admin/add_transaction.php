<?php require_once("../include/initialize.php"); ?>
<?php 
	if(!$session->is_logged_in()) { redirect_to("login.php"); }
	if(isset($_POST["submit"])) { 
		if(isset($_POST["bank_id"])) {
			$bank = Bank_Account::find_by_id($_POST["bank_id"]);
			$current_user = User::find_by_id($session->user_id);
			$trans = new Transaction();
			$trans->type = isset($_POST["type"]) ? $_POST["type"] : "";
			$trans->amount = isset($_POST["trans_amount"]) ? $_POST["trans_amount"] : "";
			$trans->date = isset($_POST["trans_date"]) ? $_POST["trans_date"] : "";
			$trans->receipt_photo   = isset($_FILES["receipt_photo"]) ? $trans->checkNewPicture($_FILES["receipt_photo"]) : "";
			$trans->user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : "";
			$trans->user = $current_user->full_name();
			$trans->company_id = $current_user->get_company_id();
			$trans->withdrawl_type = isset($_POST["withdrawl_type"]) ? $_POST["withdrawl_type"] : null;
			$trans->deposit_type = isset($_POST["deposit_type"]) ? $_POST["deposit_type"] : null;
			$trans->account_type = isset($_POST["account_type"]) ? $_POST["account_type"] : null;
			$trans->transfer_type = isset($_POST["transfer_type"]) ? $_POST["transfer_type"] : null;
			$trans->transfer_to = isset($_POST["transfer_to"]) ? (substr_count($_POST["transfer_to"], "user") > 0 ? str_ireplace("user_", "", $_POST["transfer_to"]) : str_ireplace("account_", "", $_POST["transfer_to"])) : null;
			$trans->bank_account_id = $bank->bank_account_id;
			
			if($trans->receipt_photo != "" || $trans->receipt_photo != false) {
				$trans->receipt_photo = $trans->receipt_photo[1];
				$trans->receipt = "Y";
			} else {
				$trans->receipt = "N";
			}

			if($trans->save()) {
				// Successful
				$message = "Transaction added successfully.";
				if($trans->type == "Purchase") {
					$message = "Purchase of $".$trans->amount." was saved successfully.";
					$session->message("<li class='okItem'>Purchase of $".$trans->amount." was saved successfully.</li>");
					$bank->make_purchase($trans->amount);
					redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
				} elseif($trans->type == "Refund") {
					$message = "Refund of $".$trans->amount." was saved successfully.";
					$session->message("<li class='okItem'>Refund of $".$trans->amount." was saved successfully.</li>");
					$bank->make_refund($trans->amount);
					redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
				} elseif($trans->type == "Withdrawl") {
					$message = "Withdrawl of $".$trans->amount." was saved successfully.";
					$session->message("<li class='okItem'>Withdrawl of $".$trans->amount." was saved successfully.</li>");
					$bank->make_withdrawl($trans->amount, $trans->withdrawl_type, $trans->account_type, $session->user_id);
					redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
				} elseif($trans->type == "Deposit") {
					$message = "Deposit of $".$trans->amount." was saved successfully.";
					$session->message("<li class='okItem'>Deposit of $".$trans->amount." was saved successfully.</li>");
					$bank->make_deposit($trans->amount, $trans->deposit_type, $trans->account_type, $session->user_id);
					redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
				} elseif($trans->type == "Transfer") {
					$message = "Transfer of $".$trans->amount." was saved successfully.";
					$session->message("<li class='okItem'>Transfer of $".$trans->amount." was saved successfully.</li>");
					$bank->make_transfer($trans->amount, $trans->transfer_type, $trans->transfer_to, $trans->account_type, $session->user_id);
					redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
				} else {
					$session->message("<li class='errorItem'>Transaction type unrecognized.</li>");
					redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
				}
			} else {
				// Failure
				$session->message("<li class='errorItem'>Transaction unsuccessful.</li>");
				redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
			}
		} else {
			$session->message("<li class='errorItem'>A Bank Needs To Be Selected Before Transaction Can Be Completed.</li>");
			redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
		}
	} else {
		$session->message("<li class='errorItem'>No form was submitted.</li>");
		redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
	}
?>