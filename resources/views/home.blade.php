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
		<div class="col">
			@include('layouts.nav')
		</div>
	</div>
    <div class="row">
		<div class="col-12">
			<div class="myheader">
				<div class="pictureHeader">
					<img src="{{ $user_photo != null ? $user_photo : '/images/emptyface.jpg' }}" class="" />
				</div>
				<div class="nameHeader">
					<h2 class="">{{ $user_name }}</h2>
				</div>
				<div class="lastLogin">
					<span class="lastLoginLabel">Last Login</span>
					<span class="lastLoginDate">{{ $last_login }}</span>
				</div>
			</div>
		</div>
		<div class="bankAccounts container-fluid px-3">
			<div class="row">
				<div class="col-md-10 col-sm-10 col-xs-10">
					<h1 class="">Banks</h1>				
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
					<a class="btn btn-info" href="/bank/create">Add A Bank</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-3">
					<span>Here's a list of all your banks</span>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-9">
					@if($user_accounts->count() > 0)
						@foreach($user_accounts as $user_account)
							@php $bankAccount = \App\BankAccount::find($user_account->bank_account_id); @endphp

							<div class="indBankAccount addBoxShadow">
								<div class="bankAccountHeader">
									<h2 class="">{{ $bankAccount->bank_name }}</h2>
									@if($user_account->edit_bank == "Y")
										<a href="/bank/{{ $bankAccount->id }}/edit" class="btn btn-secondary">Edit Bank Account</a>
									@else
										<div class="">
											<p class="">You have not been granted permissions to view this banks information</p>
										</div>
									@endif
								</div>
								<div class="bankAccountInfo">
									<div class="">
										<span class="spanLabel">Checking Balance:</span>
										<span class="itemContent">{{ $bankAccount->checking_balance != null ? '$' . number_format($bankAccount->checking_balance, 2) : '$0.00' }}</span>
									</div>
									<div class="">
										<span class="spanLabel">Savings Balance:</span>
										<span class="itemContent">{{ $bankAccount->savings_balance != null ? '$' . number_format($bankAccount->savings_balance, 2) : '$0.00' }}</span>
									</div>
								</div>
							</div>
						@endforeach
					@else
						<div class="emptyAccountHeader">
							<h2 class="">You do not currently have any accounts added.</h2>
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="myAccounts container-fluid px-3">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h1 class="">My Accounts</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-3">
					<span>Here's a list of your balances with all your banks</span>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-9">
					@if($user_accounts->count() > 0)
						@foreach($user_accounts as $user_account)
							<div class="indShareAccount addBoxShadow">
								<div class="myBankHeader">
									<h2 class="">{{ $user_account->bank_account->bank_name }}</h2>
								</div>
								<div class="myBankInfo">
									<div class="">
										<span class="spanLabel">My balance within checking account:</span>
										<span class="itemContent">{{ $user_account->checking_share != null ? '$' . number_format($user_account->checking_share, 2) : '$0.00' }}</span>
									</div>
									<div class="">
										<span class="spanLabel">My balance within savings account:</span>
										<span class="itemContent">{{ $user_account->savings_share != null ? '$' . number_format($user_account->savings_share, 2) : '$0.00' }}</span>
									</div>
									<div class="">
										<span class="spanLabel">Percentage of Account:</span>
										<span class="itemContent">{{ ($user_account->share_pct * 100) . "%" }}</span>
									</div>
								</div>
							</div>
						@endforeach
					@else
						<div class="emptyAccountHeader">
							<h2 class="">You do not currently have any accounts added.</h2>
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="myTransactions container-fluid px-3">
			<div class="row">
				<div class="col-xl-10 col-sm-6">
					<h1 class="">My Recent Transactions</h1>
				</div>
				<div class="col-xl-1 col-sm-3">
					<a class="btn btn-info d-block text-truncate" href="/transactions/create">Create</a></button>
				</div>
				<div class="col-xl-1 col-sm-3">
					<a class="btn btn-info d-block text-truncate" href="/transactions/">View All</a></button>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="allTransactions">
						@if($transactions->count() > 0)
							@foreach($transactions as $transaction)
								<div class="indTransaction addBoxShadow col-md-3 col-sm-5 col-xs-5 {{ strtolower($transaction->type) }}">
									<div class="myTransactionHeader">
										<h2 class=""><span class="itemContent">{{ $transaction->type }}</span><span class="transactionDate">{{ $transaction->date }}</span></h2>
									</div>
									<div class="myTransactionInfo {{ $transaction->type }}">
										<div class="">
											<span class="spanLabel">Amount:</span>
											<span class="itemContent">{{ "$" . $transaction->amount }}</span>
										</div>
										@if($transaction->type != "Transfer")
											<div class="">
												<span class="spanLabel">Receipt:</span>
												@if($transaction->receipt == "Y")
													<a class="transImg" href="{{ $transaction->receipt_photo }}">Receipt Photo</a>
												@else
													<span class="itemContent">{{ $transaction->receipt }}</span>
												@endif
											</div>
										@endif
										@if($transaction->type == "Transfer")
											<div class="">
												<span class="spanLabel">Transfer To:</span>
												@if($transaction->transfer_type == "user")
													@php $toUser = \App\User::find($transaction->transfer_to); @endphp
													<span class="itemContent"><?php echo $toUser->full_name(); ?></span>
												@else
													<span class="itemContent">{{ ucwords($transaction->transfer_to) }}</span>
												@endif
											</div>
										@endif
									</div>
								</div>
							@endforeach
						@else
							<div class="emptyAccountHeader col-md-12">
								<h2 class="">You do not have any recent transactions added.</h2>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
