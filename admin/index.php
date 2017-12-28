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
<link rel="stylesheet" href="scripts/mp/dist/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="css/atstmpllc.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="scripts/mp/dist/jquery.magnific-popup.min.js"></script>
<script src="scripts/atstmpllc.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--[if lte IE 9]> <script>window.open("oldBrowser/index.php", "_self");</script> <![endif]-->
<body>
	<div class="container-fluid">
		<?php $user = User::find_by_id($session->user_id); ?>
		<?php $userAccount = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id='".$session->user_id."';"); ?>
		<?php $transaction = Transaction::find_by_id($session->user_id); ?>
		<?php include_once("nav.php"); ?>
		<?php $session->showSessionMessages(); ?>
		<?php 
			// $UserTrans = User_Account::find_user_deposit_withdrawl_diff(1);
			// echo"<pre>";
			// print_r($UserTrans);
			// echo"</pre>";
		?>
		<div class="myheader">
			<div class="pictureHeader">
				<?php if($user->picture != null) { ?>
					<img src="<?php echo $user->picture ?>" class="" />
				<?php } else { ?>
					<img src="../images/emptyface.jpg" class="" />
				<?php } ?>
			</div>
			<div class="nameHeader">
				<h2 class=""><?php echo $user->full_name(); ?></h2>
			</div>
			<div class="lastLogin">
				<span class="lastLoginLabel">Last Login</span>
				<span class="lastLoginDate"><?php if($session->last_log_in == null) { echo "This is your first login"; } else { echo datetime_to_text($session->last_log_in); } ?></span>
			</div>
		</div>
	<div class="bankAccounts">
		<div class="row">
			<div class="col-md-10 col-sm-10 col-xs-10">
				<h1 class="">Banks</h1>				
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<a class="btn btn-default center-block" href="bank.php?create_bank">Add A Bank</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-3">
				<span>Here's a list of all the banks you have been added to</span>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-9">
				<?php if(count($userAccount) > 0) { ?>
					<?php for($i=0; $i < count($userAccount); $i++) { ?>
						<?php $bankAccount = Bank_Account::find_by_id($userAccount[$i]->bank_account_id); ?>
						<?php if($userAccount[$i]->show_bank() == "Y") { ?>
							<div class="row">
								<div class="indBankAccount addBoxShadow">
									<div class="bankAccountHeader">
										<h2 class=""><?php echo $bankAccount->bank_name; ?></h2>
										<?php if($userAccount[$i]->edit_bank() == "Y") { ?>
											<a href="bank.php?edit_bank=<?php echo $bankAccount->bank_account_id; ?>" class="">Edit Bank Account</a>
										<?php } ?>
									</div>
									<div class="bankAccountInfo">
										<div class="">
											<span class="spanLabel">Checking Balance:</span>
											<span class="itemContent"><?php echo "$" . $bankAccount->get_checking_balance(); ?></span>
										</div>
										<div class="">
											<span class="spanLabel">Savings Balance:</span>
											<span class="itemContent"><?php echo "$" . $bankAccount->get_savings_balance(); ?></span>
										</div>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="row">
								<div class="col-md-3 col-xs-2">&nbsp;</div>
								<div class="indBankAccount col-md-3 col-xs-2">
									<div class="bankAccountHeader">
										<h2 class=""><?php echo $bankAccount->bank_name; ?></h2>
									</div>
									<div class="bankAccountInfo">
										<div class="">
											<p class="">You have not been granted permissions to view this banks information</p>
										</div>
									</div>	
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } else { ?>
					<div class="row">
						<div class="emptyAccountHeader">
							<h2 class="">You do not currently have any accounts added.</h2>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		</div>
		</div>
		<div class="myAccounts">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h1 class="">My Accounts</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-3">
					<span>Here's a list of your personal balances with all your banks</span>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-9">
					<?php if(count($userAccount) > 0) { ?>
						<?php for($i=0; $i < count($userAccount); $i++) { ?>
							<div class="row">
								<div class="indShareAccount addBoxShadow">
									<div class="myBankHeader">
										<h2 class=""><?php echo $userAccount[$i]->bank_name; ?></h2>
									</div>
									<div class="myBankInfo">
										<div class="">
											<span class="spanLabel">My balance within checking account:</span>
											<span class="itemContent"><?php echo "$" . $userAccount[$i]->get_checking_share(); ?></span>
										</div>
										<div class="">
											<span class="spanLabel">My balance within savings account:</span>
											<span class="itemContent"><?php echo "$" . $userAccount[$i]->get_savings_share(); ?></span>
										</div>
										<div class="">
											<span class="spanLabel">Percentage of Account:</span>
											<span class="itemContent"><?php echo ($userAccount[$i]->get_percent_share() * 100) . "%"; ?></span>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } else { ?>
						<div class="row">
							<div class="emptyAccountHeader">
								<h2 class="">You do not currently have any accounts added.</h2>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="myTransactions">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<h1 class="">My Recent Transactions</h1>
				</div>
				<div class="col-md-3 col-sm-3">
					<a class="btn btn-default center-block" href="transactions.php?new_transaction">Create A Transaction</a></button>
				</div>
				<div class="col-md-3 col-sm-3">
					<a class="btn btn-default center-block" href="transactions.php?view_transactions">View All Transactions</a></button>
				</div>
			</div>
			<div class="row">
				<div class="allTransactions">
					<?php if(!empty($transaction)) { ?>
						<?php if(count($transaction) > 0) { ?>
							<?php for($i=0; $i < count($transaction); $i++) { ?>
								<div class="indTransaction addBoxShadow col-md-3 col-sm-5 col-xs-5 <?php echo strtolower($transaction[$i]->type); ?>">
									<div class="myTransactionHeader">
										<h2 class=""><span class="itemContent"><?php echo $transaction[$i]->type; ?></span><span class="transactionDate"><?php echo datetime_to_slash($transaction[$i]->date); ?></span></h2>
									</div>
									<div class="myTransactionInfo <?php echo $transaction[$i]->type; ?>">
										<div class="">
											<span class="spanLabel">Amount:</span>
											<span class="itemContent"><?php echo "$" . $transaction[$i]->amount; ?></span>
										</div>
										<?php if($transaction[$i]->type != "Transfer") { ?>
											<div class="">
												<span class="spanLabel">Receipt:</span>
												<?php if($transaction[$i]->receipt == "Y") { ?>
													<a class="transImg" href="<?php echo $transaction[$i]->receipt_photo; ?>">Receipt Photo</a>
												<?php } else { ?>
													<span class="itemContent"><?php echo $transaction[$i]->receipt; ?></span>
												<?php } ?>
											</div>
										<?php } ?>
										<?php if($transaction[$i]->type == "Transfer") { ?>
											<div class="">
												<span class="spanLabel">Transfer To:</span>
												<?php if($transaction[$i]->transfer_type == "user") { ?>
													<?php $toUser = User::find_by_id($transaction[$i]->transfer_to); ?>
													<span class="itemContent"><?php echo $toUser->full_name(); ?></span>
												<?php } else { ?>
													<span class="itemContent"><?php echo ucwords($transaction[$i]->transfer_to); ?></span>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					<?php } else { ?>
						<div class="emptyAccountHeader col-md-12">
							<h2 class="">You do not have any recent transactions added.</h2>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php include_once("footer.php"); ?>
	</div>
</body>
</html>