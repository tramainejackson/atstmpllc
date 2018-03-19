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
					<img src="{{ $user->picture != null ? asset('/storage/images/' . $user->picture) : '/images/emptyface.jpg' }}" class="imgPreview" />
					
					{!! Form::open(['action' => ['HomeController@update_image', 'user' => $user->id], 'files' => true, 'method' => 'PUT']) !!}
						<div class="row m-0 d-flex justify-content-between">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Upload</span>
								</div>
								<div class="custom-file">
									<input type="file" class="btn col-4 custom-file-input" name="profile_img" id="customFile" />
									<label for="customFile" class="custom-file-label">Change Photo</label>
								</div>
							</div>
							<input type="submit" class="btn hidden align-self-right col-4 profile_img_submit" name="submit" value="Save New Picture" />
						</div>
					{!! Form::close() !!}
				</div>
				<div class="nameHeader">
					<h2 class="">{{ $user_name }}</h2>
				</div>
				<div class="lastLogin">
					<span class="lastLoginLabel">Last Login</span>
					<span class="lastLoginDate">{{ $last_login->toFormattedDateString() }}</span>
				</div>
			</div>
		</div>
		<div class="bankAccounts container-fluid px-3">
			<div class="row">
				<div class="col-6">
					<h1 class="">Banks</h1>				
				</div>
				<div class="col text-right">
					<a class="btn btn-info" href="/bank/create">Add A Bank</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<span>Here's a list of all your banks</span>
				</div>
				<div class="col">
					@if($user_accounts)
						@foreach($user_accounts as $user_account)
							@php $bankAccount = \App\BankAccount::find($user_account->bank_account_id); @endphp

							<div class="indBankAccount addBoxShadow p-sm-4">
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
				<div class="col-12">
					<span>Here's a list of your balances with all your banks</span>
				</div>
				<div class="col">
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
										<span class="spanLabel">Ownership of Account:</span>
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
			<div class="row mb-2">
				<div class="col-12">
					<h1 class="">My Recent Transactions</h1>
				</div>
				<div class="col-12">
					<a class="btn btn-info d-block text-truncate" href="/transactions/create">Create</a></button>
				</div>
				<div class="col-12">
					<a class="btn btn-info d-block text-truncate" href="/transactions/">View All</a></button>
				</div>
			</div>
			<div class="row">
				@if($transactions->count() > 0)
					@foreach($transactions as $transaction)
						<div class="col-xl-3">
							<div class="indTransaction addBoxShadow {{ strtolower($transaction->type) }}">
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
												<a class="transImg" href="{{ $transaction->receipt_photo != null ? asset('/storage/images/' . $transaction->receipt_photo) : '/images/emptyface.jpg' }}">Receipt Photo</a>
											@else
												<span class="itemContent">{{ $transaction->receipt }}</span>
											@endif
										</div>
									@endif
									@if($transaction->type == "Transfer")
										<div class="">
											<span class="spanLabel">Transfer To:</span>
											@if($transaction->transfer_type == "user")
												@php $toUser = \App\UserAccount::find($transaction->transfer_to); @endphp
												<span class="itemContent">{{ $toUser->user->firstname }}</span>
											@else
												<span class="itemContent">{{ ucwords($transaction->transfer_to) }}</span>
											@endif
										</div>
									@endif
								</div>
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
@endsection
