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
				<a href="/transactions/create" class="btn col-3">Create A New Transaction</a>
			</div>
		</div>
		<div class="col-8 mx-auto">
			@if($user_transactions->count() > 0)
				<div class="userTransactionHeader">
					<h2 class="">{{ "All transactions for: " . $user_name }}</h2>
				</div>
				<div class="row">
					@foreach($user_transactions as $transaction)
						<div class="col-md-4 col-sm-6 col-xs-6">
							<div class="indTransaction addBoxShadow{{ ' ' . $transaction->type }}">
								<div class="myTransactionHeader">
									<h2><span class="itemContent">{{ $transaction->type }}</span><span class="transactionDate">{{ $transaction->date }}</span></h2>
								</div>
								<div class="myTransactionInfo">
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
												@php $toUser = $transaction->bank_account->user_accounts->where('user_id', $transaction->transfer_to)->first(); @endphp
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
				</div>
			@else
				<div class="emptyAccountHeader">
					<h2 class="">No transactions added for this user.</h2>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection