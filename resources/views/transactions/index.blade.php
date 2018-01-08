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
					<a href="/transactions/create" class="btn col-3">Create A New Transaction</a>
				</div>
			</div>
			<div class="col-12">
				<h2 class="mb-4 text-muted">{{ $user->company->company_name }} Transactions</h2>
			</div>
		</div>
		<div class="row">
			@if($companyTransactions->isNotEmpty())
				@foreach($companyTransactions as $transaction)
					<div class="col-4">
						<div class="indTrans addBoxShadow{{ ' ' .strtolower($transaction->type) }}">
							<div class="indTransHeader">
								<h2 class=""><span class="itemContent">{{ $transaction->type }}</span><span class="indTransactionDate">{{ $transaction->date }}</span></h2>
							</div>
							<div class="indTransInfo">
								<div class="">
									<span class="spanLabel">User Completed:</span>
									<span class="itemContent"><a href="/transactions/{{ $transaction->user_account_id }}">{{ $transaction->user_account->user->firstname }}</a></span>
								</div>
								<div class="">
									<span class="spanLabel">Bank:</span>
									<span>{{ $transaction->bank_account->bank_name }}</span>
								</div>
								<div class="">
									<span class="spanLabel">Amount:</span>
									<span class="itemContent">{{ "$" . $transaction->amount }}</span>
									
									@if($transaction->type != "Transfer")
										<div class="">
											<span class="spanLabel">Receipt:</span>
											@if($transaction->receipt == "Y")
												<a class="transImg" href="{{ asset('/storage/images/' . $transaction->receipt_photo) }}">Receipt Photo</a>
											@else
												<span class="itemContent">None Attached</span>
											@endif
										</div>
									@endif
								</div>
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
				<div class="col-12">
					<h2 class="">Your company does not have any transactions added yet. Click <a href="/transactions/create" class="">here</a> to create a transaction.</h2>
				</div>
			@endif
		</div>
	</div>
@endsection