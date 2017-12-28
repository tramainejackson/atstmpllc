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
<script src="scripts/colorbox/jquery.colorbox-min.js"></script>
<script src="scripts/atstmpllc.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--[if lte IE 9]> <script>window.open("oldBrowser/index.php", "_self");</script> <![endif]-->
<body>
<div class="container-fluid">
	<?php $user = User::find_by_id($session->user_id); ?>
	<?php $userAccount = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id='".$session->user_id."';"); ?>
	<?php include_once("nav.php"); ?>
	<?php $session->showSessionMessages(); ?>
	<?php if(!isset($_GET["create_bank"])) { ?>
		<div class="createBankLink">
			<a href="bank.php?create_bank" class="banksPageAddBank">Create New Bank Account</a>
		</div>
	<?php } ?>
	<?php if(!isset($_GET)) { ?>
		<div class="banksPageHeader">
			<h2 class="">List of all the banks you have an account added.</h2>
		</div>
	<?php } ?>
	<?php if(isset($_GET["create_bank"])) { ?>
	<div class="createNewBank">
		<div class="row">
			<div class="formDiv">
				<div class="formDivTitle row">
					<h2 class="">Create A New Bank</h2>
				</div>
				<div class="createBankContent row">
					<form name="" class="" action="add_bank.php" method="POST" enctype="multipart/form-data" onsubmit="bankErrorCheck();">
						<div class="row">
							<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Bank Name</span>
							<input type="text" name="bank_name" class="newBankName col-md-6 col-sm-6 col-xs-5" value="" placeholder="Enter Bank Name" />
						</div>
						<div class="row">
							<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Account Number</span>
							<input type="text" name="account_num" class="newBankAN col-md-6 col-sm-6 col-xs-5" value="" placeholder="Enter Account Number" />
						</div>
						<div class="balanceInputDiv row">
							<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Checking Balance</span>
							<input type="number" name="checking_balance" class="newBankBalanceC balanceInput col-md-6 col-sm-6 col-xs-5" value="" placeholder="0.00" />
						</div>
						<div class="balanceInputDiv row">
							<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Saving Balance</span>
							<input type="number" name="savings_balance" class="newBankBalanceS balanceInput col-md-6 col-sm-6 col-xs-5" value="" placeholder="0.00" />
						</div>
						<div class="row">
							<input hidden type="text" name="added_by" value="<?php echo $user->full_name(); ?>" />
							<input hidden type="text" name="owner_id" value="<?php echo $user->user_id; ?>" />
						</div>
						<div class="row">
							<input type="submit" name="submit" class="" value="Create" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if(isset($_GET["edit_bank"])) { ?>
		<?php $editable_banks = $userAccount[0]->get_users_editable_banks(); ?>
		<?php if(in_array($_GET["edit_bank"], $editable_banks)) { ?>
			<?php $editBankAccount = Bank_Account::find_by_id($_GET["edit_bank"]); ?>
			<?php $editBankUsers = User_Account::find_by_sql("SELECT * FROM user_account WHERE bank_account_id = '".$_GET["edit_bank"]."';"); ?>
			<div class="editBank row">
				<div class="formDiv">
					<form name="" class="row" action="edit_bank.php" method="POST" enctype="multipart/form-data" onsubmit="bankErrorCheck();">
						<div class="formDivTitle">
						<h2 class="">Edit Bank Information</h2>
					</div>
						<div class="row">
							<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Bank Name</span>
							<input type="text" name="bank_name" class="newBankName col-md-6 col-sm-6 col-xs-5" value="<?php echo $editBankAccount->bank_name; ?>" placeholder="" />
						</div>
						<div class="row">
							<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Account Number</span>
							<input type="text" name="account_num" class="newBankAN col-md-6 col-sm-6 col-xs-5" value="<?php echo $editBankAccount->get_account_num(); ?>" placeholder="" />
						</div>
						<div class="balanceInputDiv row">
							<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Checking Balance</span>
							<input type="number" name="checking_balance" class="newBankBalanceC balanceInput col-md-6 col-sm-6 col-xs-5" value="<?php echo number_format($editBankAccount->get_checking_balance(), 2); ?>" placeholder="" />
						</div>
						<div class="balanceInputDiv row">
							<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Saving Balance</span>
							<input type="number" name="savings_balance" class="newBankBalanceS balanceInput col-md-6 col-sm-6 col-xs-5" value="<?php echo number_format($editBankAccount->get_savings_balance(), 2); ?>" placeholder="" />
						</div>
						<div class="row">
							<input hidden type="text" name="bank_id" value="<?php echo $editBankAccount->bank_account_id; ?>" />
						</div>
						<div class="bankUsers row">
							<?php foreach($editBankUsers as $editBankUser) { ?>
								<?php $editBankUser_user = User::find_by_id($editBankUser->user_id); ?>
								<div class="editBankUser row">
									<div class="row">
										<span class="spanLabel col-md-4 col-sm-4 col-xs-5">User</span>
										<input type="text" name="user" class="col-md-6 col-sm-6 col-xs-5" value="<?php echo $editBankUser->user; ?>" placeholder="" disabled />
									</div>
									<div class="row">
										<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Can Edit Bank</span>
										<?php if($editBankUser_user->is_editable() == "Y") { ?>
											<select class="col-md-6 col-sm-6 col-xs-5" name="edit_bank[]">
												<?php if($editBankUser->edit_bank() == "Y") { ?>
													<option value="Y" selected>Yes</option>
													<option value="N">No</option>
												<?php } else { ?>
													<option value="Y">Yes</option>
													<option value="N" selected>No</option>
												<?php } ?>
											</select>
										<?php } else { ?>
											<select class="col-md-6 col-sm-6 col-xs-5" name="show_bank[]" disabled>
												<option value="admin">Administrator</option>
											</select>
										<?php } ?>
									</div>
									<div class="row">
										<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Can View Bank Info</span>
										<?php if($editBankUser_user->is_editable() == "Y") { ?>
											<select class="col-md-6 col-sm-6 col-xs-5" name="show_bank[]">
												<?php if($editBankUser->show_bank() == "Y") { ?>
													<option value="Y" selected>Yes</option>
													<option value="N">No</option>
												<?php } else { ?>
													<option value="Y">Yes</option>
													<option value="N" selected>No</option>
												<?php } ?>
											</select>
										<?php } else { ?>
											<select class="col-md-6 col-sm-6 col-xs-5" name="show_bank[]" disabled>
												<option value="admin">Administrator</option>
											</select>
										<?php } ?>
									</div>
									<div hidden class="">
										<?php if($editBankUser_user->is_editable() == "Y") { ?>
											<input type="text" name="user_account_id[]" class="" value="<?php echo $editBankUser->user_account_id; ?>" placeholder="" />
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="row">
							<input type="submit" name="submit" class="" value="Edit" />
						</div>
					</form>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	<?php if(isset($_GET["create_share"])) { ?>
		<div class="createShare row">
			<div class="formDiv">
				<form name="new_share" class="" action="add_share.php" method="POST" enctype="multipart/form-data">
					<div class="formDivTitle row">
						<h2 class="">Create A Users Share</h2>
					</div>
					<div class="row">
						<span class="spanLabel col-md-4 col-sm-4 col-xs-5">Bank</span>
						<select class="col-md-6 col-sm-6 col-xs-5" name="bank_id">
							<option value="blank">----- Select a Bank -----</option>
								<?php if(count($userAccount) > 0) { ?>
									<?php for($i=0; $i < count($userAccount); $i++) { ?>
										<?php $bankAccount = Bank_Account::find_by_id($userAccount[$i]->bank_account_id); ?>
										<?php if($userAccount[$i]->edit_bank() == "Y") { ?>
											<?php if($bankAccount->bank_account_id == $_GET["create_share"]) { ?>
												<option value="<?php echo $bankAccount->bank_account_id; ?>" selected><?php echo $bankAccount->bank_name; ?></option>
											<?php } else { ?>
												<option value="<?php echo $bankAccount->bank_account_id; ?>"><?php echo $bankAccount->bank_name; ?></option>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
						</select>
					</div>
					<div class="row">
						<span class="spanLabel col-md-4 col-sm-4 col-xs-5">User</span>
						<select class="col-md-6 col-sm-6 col-xs-5" name="user_id">
							<option value="blank">----- Select a User -----</option>
								<?php $usersAll = User::find_all($user->get_company_id()); ?>
								<?php for($i=0; $i < count($usersAll); $i++) { ?>
									<?php if($usersAll[$i]->is_removed() == "N") { ?>
										<?php if($checkAccount = User_Account::find_by_sql("SELECT * FROM user_account WHERE bank_account_id = '".$_GET["create_share"]."' AND user_id = '".$usersAll[$i]->user_id."';")) { ?>
											<option value="<?php echo $usersAll[$i]->user_id; ?>" disabled><?php echo $usersAll[$i]->full_name(); ?></option>
										<?php } else { ?>
											<option value="<?php echo $usersAll[$i]->user_id; ?>"><?php echo $usersAll[$i]->full_name(); ?></option>
										<?php } ?>
									<?php } ?>
								<?php } ?>
						</select>
					</div>
					<div class="row">
						<span class="col-md-4 col-sm-4 col-xs-5">Share Percentage</span>
						<input type="number" name="share_pct" class="col-md-6 col-sm-6 col-xs-5" />
					</div>
					<div class="row">
						<input type="submit" name="submit" class="" value="Create" />
					</div>
				</form>
			</div>
		</div>
	<?php } ?>
	<?php if(isset($_GET["edit_share"])) { ?>
		<?php $editable_banks = $userAccount[0]->get_users_editable_banks(); ?>
		<?php if(in_array($_GET["edit_share"], $editable_banks)) { ?>
			<?php $editBankAccount = Bank_Account::find_by_id($_GET["edit_share"]); ?>
			<?php $editShareUsers = User_Account::find_by_sql("SELECT * FROM user_account WHERE bank_account_id = '".$_GET["edit_share"]."';"); ?>
			<div class="editBank row">
				<div class="formDiv">
					<form name="" class="" action="edit_share.php" method="POST" enctype="multipart/form-data">
						<div class="row">
							<?php if($editBankAccount->bank_account_id == $_GET["edit_share"]) { ?>
								<h2><?php echo $editBankAccount->bank_name; ?></h2>
								<input hidden type="number" name="bank_id" class="" value="<?php echo $editBankAccount->bank_account_id;  ?>" />
							<?php } ?>
						</div>
						<?php foreach($editShareUsers as $editShareUser) { ?>
							<?php $editShareUsers_user = User::find_by_id($editShareUser->user_id); ?>
							<div class="row userPercentShareDiv">
								<div class="row">
									<span class="spanLabel col-md-4">User</span>
									<input disabled type="text" name="user[]" class="col-md-6" value="<?php echo $editShareUser->user; ?>" />
								</div>
								<div class="row">
									<span class="spanLabel col-md-4">Share Percentage</span>
									<input type="number" name="share_pct[]" class="col-md-6" value="<?php echo ($editShareUser->get_percent_share() * 100); ?>" />
								</div>
								<div class="">
									<input hidden type="number" name="user_account_id[]" class="" value="<?php echo $editShareUser->user_account_id; ?>" />
								</div>
							</div>
						<?php } ?>
						<div class="row">
							<input type="submit" name="submit" class="" value="Edit" />
						</div>
					</form>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	<?php if(!empty($userAccount)) { ?>
		<?php if(count($userAccount) > 0) { ?>
			<div class="row">
				<?php for($i=0; $i < count($userAccount); $i++) { ?>
					<?php $bankAccount = Bank_Account::find_by_id($userAccount[$i]->bank_account_id); ?>
					<?php if($userAccount[$i]->show_bank() == "Y") { ?>
						<div class="indBankAccount addBoxShadow center-block">
							<div class="bankAccountHeader">
								<h2 class=""><?php echo $bankAccount->bank_name; ?></h2>
							</div>
							<div class="bankAccountInfo">
								<div class="">
									<div class="">
										<h3 class="">Checking: </h3>
									</div>
									<div class="">
										<span class="spanLabel">Balance:</span>
										<span class="itemContent"><?php echo "$" . number_format($bankAccount->get_checking_balance(), 2); ?></span>
									</div>
									<div class="">
										<span class="spanLabel">My Share:</span>
										<span class="itemContent"><?php echo "$" . number_format($userAccount[$i]->get_checking_share(), 2); ?></span>
									</div>
								</div>
								<div class="">
									<div class="">
										<h3 class="">Saving: </h3>
									</div>
									<div class="">
										<span class="spanLabel">Balance:</span>
										<span class="itemContent"><?php echo "$" . number_format($bankAccount->get_savings_balance(), 2); ?></span>
									</div>
									<div class="">
										<span class="spanLabel">My Share:</span>
										<span class="itemContent"><?php echo "$" . number_format($userAccount[$i]->get_savings_share(), 2); ?></span>
									</div>
								</div>
								<div class="">
									<?php if($userAccount[$i]->edit_bank() == "Y") { ?>
										<div class="">
											<h3 class="">Share Split</h3>
										</div>	
										<div class="">
											<?php $allUserAccounts = User_Account::find_by_sql("SELECT * from user_account WHERE bank_account_id = '".$bankAccount->bank_account_id."';"); ?>
											<?php foreach($allUserAccounts as $allUserAccount) { ?>
												<span><?php echo $allUserAccount->user; ?>:</span>
												<span><?php echo ($allUserAccount->get_percent_share() * 100) . "%"; ?></span>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="indBankAccountLinks row">
								<?php if($userAccount[$i]->edit_bank() == "Y") { ?>
									<div class="row">
										<?php if(isset($_GET["edit_bank"])) { ?>
											<?php if($_GET["edit_bank"] != $bankAccount->bank_account_id) { ?>
												<div class="col-md-4">
													<a class="center-block editBankLink" href="bank.php?edit_bank=<?php echo $bankAccount->bank_account_id; ?>" class="">Edit Bank Account</a>
												</div>
											<?php } ?>
										<?php } else { ?>
											<div class="col-md-4">
												<a class="center-block editBankLink" href="bank.php?edit_bank=<?php echo $bankAccount->bank_account_id; ?>" class="">Edit Bank Account</a>
											</div>
										<?php } ?>
										<?php if(isset($_GET["edit_share"])) { ?>
											<?php if($_GET["edit_share"] != $bankAccount->bank_account_id) { ?>
												<div class="col-md-4">
													<a class="center-block editBankLink" href="bank.php?edit_share=<?php echo $bankAccount->bank_account_id; ?>" class="">Edit Users Shares</a>
												</div>
											<?php } ?>
										<?php } else { ?>
											<div class="col-md-4">
												<a class="center-block editBankLink" href="bank.php?edit_share=<?php echo $bankAccount->bank_account_id; ?>" class="">Edit Users Shares</a>
											</div>
										<?php } ?>
										<?php if(isset($_GET["create_share"])) { ?>
											<?php if($_GET["create_share"] != $bankAccount->bank_account_id) { ?>
												<div class="col-md-4">
													<a class="center-block editBankLink" href="bank.php?create_share=<?php echo $bankAccount->bank_account_id; ?>" class="">Create New Share</a>
												</div>
											<?php } ?>
										<?php } else { ?>
											<div class="col-md-4">
												<a class="center-block editBankLink" href="bank.php?create_share=<?php echo $bankAccount->bank_account_id; ?>" class="">Create New Share</a>
											</div>
										<?php } ?>
									</div>
								<?php } ?>	
							</div>
						</div>
					<?php } else { ?>
						<div class="indBankAccount">
							<div class="bankAccountHeader">
								<h2 class=""><?php echo $bankAccount->bank_name; ?></h2>
							</div>
							<div class="bankAccountInfo">
								<div class="">
									<p class="">You have not been granted permissions to view this banks information</p>
								</div>
							</div>	
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		<?php } else { ?>
			<div class="emptyAccountHeader">
				<h2 class="">You do not currently have any accounts added.</h2>
			</div>
		<?php } ?>
	<?php } ?>
	<?php include_once("footer.php"); ?>
</div>
</body>
</html>