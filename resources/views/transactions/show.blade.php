@extends('layouts.app')

@section('styles')
	@include('layouts.styles.bootstrap_css')
@endsection

@section('scripts')
	@include('layouts.functions.bootstrap_js')
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			@include('layouts.nav')
		</div>
		<div class="col-8 my-4 mx-auto">
			<div class="userNavLinks d-flex justify-content-around">
				<a href="/transactions" class="btn col-3">All Transactions</a>
			</div>
		</div>
		<div class="col-8 mx-auto">
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
		</div>
	</div>
</div>
@endsection