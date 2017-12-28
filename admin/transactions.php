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
	<?php include_once("nav.php"); ?>
	<?php $session->showSessionMessages(); ?>
	<?php $checkUserAccounts = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id='".$session->user_id."';"); ?>
	<?php $companyTransactions = Transaction::find_all($user->get_company_id()); ?>
	<?php if(isset($_GET["new_transaction"])) { ?>
		<?php if(!empty($checkUserAccounts)) { ?>
			<?php $userAccount = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id='".$session->user_id."';"); ?>
			<?php $transaction = Transaction::find_all($user->get_company_id()); ?>
			<div class="transNav">
				<a href="transactions.php?view_transactions">View All Transactions</a>
			</div>
			<div class="addTrans row">
				<div class="formDiv">
					<form name="" class="" action="add_transaction.php" method="POST" enctype="multipart/form-data" onsubmit="transErrorCheck();">
						<div class="formDivTitle row">
							<h2 class="">Create New Transaction</h2>
						</div>
						<div class="row">
							<div class="row">
								<span class="spanLabel col-md-4">Transaction Type</span>
								<select class="transactionSelect col-md-6" name="type">
									<option value="Purchase" selected>Purchase</option>
									<option value="Transfer" <?php echo isset($_GET['transfer']) ? "selected" : ""; ?>>Transfer</option>
									<option value="Deposit" <?php echo isset($_GET['deposit']) ? "selected" : ""; ?>>Deposit</option>
									<option value="Withdrawl" <?php echo isset($_GET['withdrawl']) ? "selected" : ""; ?>>Withdrawl</option>
									<option value="Refund" <?php echo isset($_GET['refund']) ? "selected" : ""; ?>>Refund</option>
								</select>
							</div>
							<div class="row">
								<span class="spanLabel col-md-4">Bank</span>
								<select class="bankSelect col-md-6" name="bank_id">
									<option value="blank" selected disabled>----- Select a Bank -----</option>
									<?php if(count($userAccount) > 0) { ?>
										<?php for($i=0; $i < count($userAccount); $i++) { ?>
											<?php $bankAccount = Bank_Account::find_by_sql("SELECT * FROM bank_account WHERE bank_account_id='".$userAccount[$i]->bank_account_id."' LIMIT 1;"); ?>
												<option value="<?php echo $bankAccount[0]->bank_account_id; ?>" <?php if(isset($_GET['bank'])) { if($_GET['bank'] == $bankAccount[0]->bank_account_id) { echo "selected"; }} ?>><?php echo $bankAccount[0]->bank_name . " - $" . $bankAccount[0]->get_checking_balance(); ?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</div>
							<?php if(isset($_GET['deposit'])) { ?>
								<div class="row">
									<span class="spanLabel col-md-4">Deposit Type</span>
									<select class="col-md-6" name="deposit_type">
										<option value="personal" selected>Personal</option>
										<option value="company">Company Income</option>
									</select>
								</div>
							<?php } elseif(isset($_GET['withdrawl'])) { ?>
								<div class="row">
									<span class="spanLabel col-md-4">Withdrawl Type</span>
									<select class="col-md-6" name="withdrawl_type">
										<option value="personal" selected>Personal</option>
										<option value="company">Company Withdrawl</option>
									</select>
								</div>
							<?php } elseif(isset($_GET['transfer'])) { ?>
								<div class="row">
									<span class="spanLabel col-md-4">Transfer Type</span>
									<select class="transferAccountType col-md-6" name="transfer_type">
										<option value="blank" selected disabled>----- Select a Transfer Type -----</option>
										<option value="account" <?php if(isset($_GET['type'])) { if($_GET['type'] == "account") { echo "selected"; }} ?>>Account Transfer</option>
										<option value="user" <?php if(isset($_GET['type'])) { if($_GET['type'] == "user") { echo "selected"; }} ?>>User Transfer</option>
									</select>
								</div>
							<?php } ?>
							<?php if(isset($_GET['withdrawl']) || isset($_GET['deposit'])) {?>
								<div class="row">
									<span class="spanLabel col-md-4">Account Type</span>
									<select class="col-md-6" name="account_type">
										<option value="checking" selected>Checking</option>
										<option value="savings">Savings</option>
									</select>
								</div>
							<?php } ?>
							<?php if(isset($_GET['transfer']) && isset($_GET['bank']) && isset($_GET['type'])) { ?>
								<div class="row">
									<span class="spanLabel col-md-4">Send From</span>
									<select class="col-md-6" name="account_type">
										<option value="blank" disabled>---- Select Account To Send From ----</option>
										<option value="checking" selected>Checking</option>
										<option value="savings">Savings</option>
									</select>
								</div>
								<div class="row">
									<span class="spanLabel col-md-4">Send To</span>
									<select class="col-md-6" name="transfer_to">
										<?php if($_GET['type'] == "account") { ?>
											<option value="blank" disabled>---- Select Account To Send To ----</option>
											<option value="account_checking">Checking</option>
											<option value="account_savings" selected>Savings</option>
										<?php } elseif($_GET['type'] == "user") { ?>
											<?php $otherUser = User_Account::find_by_sql("SELECT * FROM user_account WHERE bank_account_id = '".$_GET['bank']."' AND user_id <> '".$session->user_id."'"); ?>
											<?php if(!empty($otherUser)) { ?>
												<option value="blank" disabled>---- Select User To Send To ----</option>
												<?php for($i=0; $i < count($otherUser); $i++) { ?>
													<option value="user_<?php echo $otherUser[$i]->user_id; ?>"><?php echo $otherUser[$i]->user; ?></option>
												<?php } ?>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							<?php } ?>
							<div class="balanceInputDiv row">
								<span class="spanLabel col-md-4">Amount</span>
								<input type="number" name="trans_amount" title="Remeber to add the cents." class="balanceInput transAmount col-md-6" value="" placeholder="0.00" step="0.01" />
							</div>
							<div class="row">
								<span class="spanLabel col-md-4">Date</span>
								<input type="date" name="trans_date" class="col-md-6" value="" required />
							</div>
							<?php if(!isset($_GET['transfer'])) { ?>
								<div class="row">
									<span class="spanLabel col-md-4">Receipt</span>
									<select class="col-md-6" name="receipt">
										<option value="Y">Yes</option>
										<option value="N">No</option>
									</select>
								</div>
								<div class="row">
									<span class="spanLabel col-md-4">Receipt Photo</span>
									<input type="file" name="receipt_photo" class="col-md-6" value="" placeholder="" />
								</div>
							<?php } ?>
							<div class="row">
								<span class="spanLabel col-md-4">User</span>
								<input disabled type="text" name="trans_user" class="col-md-6" value="<?php echo $user->full_name(); ?>" />
								<input hidden type="text" name="user_id" class="" value="<?php echo $user->user_id; ?>" />
							</div>
							<div class="row">
								<input type="submit" name="submit" class="" value="Create" />
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } else { ?>
			<div class="addTrans formDiv">
				<div class="">
					<h2 class="">You do not have any accounts added yet. Click <a href="bank.php" class="">here</a> to add an account.</h2>
				</div>
			</div>
		<?php } ?>
	<?php } elseif(isset($_GET["view_transactions"])) { ?>
		<?php if(!empty($companyTransactions)) { ?>
			<?php if(isset($_GET["id"])) { ?>
				<?php $get_user = User::find_by_id($_GET['id']); ?>
				<?php if(!empty($get_user)) { ?>
					<?php $user_transactions = Transaction::find_by_sql("SELECT * FROM transaction WHERE user_id = '".$get_user->user_id."' AND company_id = '".$user->get_company_id()."' ORDER BY transaction_id DESC;"); ?>
					<div class="transNav">
						<a href="transactions.php?new_transaction">Create A New Transaction</a>
						<a href="transactions.php?view_transactions">View All Transactions</a>
					</div>
					<div class="row">
						<?php if(!empty($user_transactions)) { ?>
							<?php if(count($user_transactions) > 0) { ?>
								<div class="userTransactionHeader">
									<h2 class=""><?php echo "All transactions for: " . $get_user->full_name(); ?></h2>
								</div>
								<div class="row">
									<?php foreach($user_transactions as $transaction) { ?>
										<div class="col-md-4 col-sm-6 col-xs-6">
											<div class="indTransaction addBoxShadow <?php echo $transaction->type; ?>">
												<div class="myTransactionHeader">
													<h2><span class="itemContent"><?php echo $transaction->type; ?></span><span class="transactionDate"><?php echo datetime_to_slash($transaction->date); ?></span></h2>
												</div>
												<div class="myTransactionInfo">
													<div class="">
														<span class="spanLabel">Amount:</span>
														<span class="itemContent"><?php echo "$" . $transaction->amount; ?></span>
													</div>
													<?php if($transaction->type != "Transfer") { ?>
														<div class="">
															<span class="spanLabel">Receipt:</span>
															<?php if($transaction->receipt == "Y") { ?>
																	<a class="transImg" href="<?php echo $transaction->receipt_photo; ?>">Receipt Photo</a>
															<?php } else { ?>
																	<span class="itemContent"><?php echo $transaction->receipt; ?></span>
															<?php } ?>
														</div>
													<?php } ?>
													<?php if($transaction->type == "Transfer") { ?>
														<div class="">
															<span class="spanLabel">Transfer To:</span>
															<?php if($transaction->transfer_type == "user") { ?>
																<?php $toUser = User::find_by_id($transaction->transfer_to); ?>
																<span class="itemContent"><?php echo $toUser->full_name(); ?></span>
															<?php } else { ?>
																<span class="itemContent"><?php echo ucwords($transaction->transfer_to); ?></span>
															<?php } ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="emptyAccountHeader">
								<h2 class="">No transactions added for this user.</h2>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="">
						<a href="transactions.php?new_transaction">Create A New Transaction</a>
						<a href="transactions.php?view_transactions">View All Transactions</a>
					</div>
					<div class="emptyAccountHeader">
						<h2 class="">No transactions added for this user.</h2>
					</div>
				<?php } ?>
			<?php } else { ?>
				<?php $transaction = Transaction::find_all($user->get_company_id()); ?>
				<div class="transNav">
					<a href="transactions.php?new_transaction">Create A New Transaction</a>
				</div>
				<div class="row">
					<?php if(!empty($transaction)) { ?>
						<?php if(count($transaction) > 0) { ?>
							<?php for($i=0; $i < count($transaction); $i++) { ?>
							<div class="col-md-4 col-sm-6 col-xs-6">
								<div class="indTrans addBoxShadow center-block <?php echo strtolower($transaction[$i]->type); ?>">
									<div class="indTransHeader">
										<h2 class=""><span class="itemContent"><?php echo $transaction[$i]->type; ?></span><span class="indTransactionDate"><?php echo datetime_to_slash($transaction[$i]->date); ?></span></h2>
									</div>
									<div class="indTransInfo">
										<div class="">
											<span class="spanLabel">User Completed:</span>
											<span class="itemContent"><a href="transactions.php?view_transactions&id=<?php echo $transaction[$i]->user_id; ?>"><?php echo $transaction[$i]->user; ?></a></span>
										</div>
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
							</div>
							<?php } ?>
						<?php } ?>
					<?php } else { ?>
						<div class="emptyAccountHeader">
							<h2 class="">You do not have any recent transactions added.</h2>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		<?php } else { ?>
			<div class="transNav">
				<a href="transactions.php?new_transaction">Create A New Transaction</a>
				<a href="transactions.php?view_transactions">View All Transactions</a>
			</div>
			<div class="">
				<h2 class="">Your company does not have any transactions added yet. Click <a href="transactions.php?new_transaction" class="">here</a> to create a transaction.</h2>
			</div>
		<?php } ?>
	<?php } else { ?>
		<div class="transNav">
			<a href="transactions.php?new_transaction">Create A New Transaction</a>
			<a href="transactions.php?view_transactions">View All Transactions</a>
		</div>
	<?php } ?>
	<?php include_once("footer.php"); ?>
</div>
</body>
</html>