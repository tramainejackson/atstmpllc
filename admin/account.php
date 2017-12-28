<?php require_once("../include/initialize.php"); ?>
<?php 
	if(!$session->is_logged_in()) { redirect_to("login.php"); }
	if(isset($_POST["submit"])) {
		$user = User::find_by_id($session->user_id);
		$bank = new Bank_Account();
		$user_account = new User_Account();
		$user_account->bank_name = $bank->bank_name = isset($_POST["bank_name"]) ? $_POST["bank_name"] : "";
		$bank->set_account_num(isset($_POST["account_num"]) ? $_POST["account_num"] : 0);
		$user_account->checking_share = $bank->set_checking_balance(isset($_POST["checking_balance"]) ? $_POST["checking_balance"] : 0);
		$user_account->savings_share = $bank->set_savings_balance(isset($_POST["savings_balance"]) ? $_POST["savings_balance"] : 0);
		$user_account->user_id = $user_account->bank_owner_id = $bank->set_owner_id($user->user_id);
		$user_account->user = $bank->added_by = $user->full_name();
			
		if($bank->save()){
			//Successful
			$user_account->bank_account_id = $db->insert_id();
			$user_account->set_show_bank("Y");
			$user_account->set_edit_bank("Y");
			$user_account->set_share_pct(100);
			if($user_account->save()) {
				redirect_to("account.php");
			} else {
				
			}
		} else {
			
		}
	} else {
		
	}
?>
<html>
<meta />
<meta />
<meta />
<meta />
<meta />
<meta />
<link rel="stylesheet" type="text/css" href="css/atstmpllc.css"/>
<script src="scripts/jquery-2.1.3.min.js"></script>
<script src="scripts/atstmpllc.js"></script>
<!--[if lte IE 9]> <script>window.open("oldBrowser/index.php", "_self");</script> <![endif]-->
<body>
<div id="container">
	<?php include_once("nav.php"); ?>
	<?php $myBanks = Bank_Account::find_by_sql("SELECT * FROM bank_account WHERE owner_id = '".$session->user_id."';"); ?>
	<?php //echo "<pre>"; ?>
	<?php //print_r($myBanks); ?>
	<?php //echo "<pre>"; ?>
	<div class="">
		<form name="" class="" action="account.php" method="POST">
			<div class="">
				<span class="spanLabel">Bank Name</span>
				<select class="" name="bank_name">
				<?php for($i=0; $i < count($myBanks); $i++) { ?>
					<option value="<?php echo $myBanks[$i]->bank_name; ?>"><?php echo $myBanks[$i]->bank_name; ?></option>
				<?php } ?>
				</select>
			</div>
			<div class="">
				<span class="spanLabel">Account Number</span>
				<input type="text" name="account_num" class="" value="" placeholder="" />
			</div>
			<div class="">
				<span class="spanLabel">Checking Balance</span>
				<input type="text" name="checking_balance" class="" value="" placeholder="" />
			</div>
			<div class="">
				<span class="spanLabel">Saving Balance</span>
				<input type="text" name="savings_balance" class="" value="" placeholder="" />
			</div>
			<div class="">
				<input type="submit" name="submit" class="" value="submit" />
			</div>
		</form>
	</div>
</div>
</body>
</html>