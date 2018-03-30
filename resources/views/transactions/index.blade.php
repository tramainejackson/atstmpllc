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
				<div class="userNavLinks d-flex flex-column flex-lg-row justify-content-around align-items-stretch">
					<a href="/transactions/create" class="btn col-12 col-lg-6">New Transaction</a>
					<a href="/user/{{ $user->id }}/transactions" class="btn col-12 col-lg-6">My Transactions</a>
				</div>
			</div>
			<div class="col-12">
				<h2 class="mb-2 text-muted">{{ $user->company->company_name }} Transactions</h2>
				<h5 class="mt-0 mb-4 text-muted"><u>Total Transactions:</u>&nbsp;<span><em>{{ $totalCompanyTransactions }}</em></span></h5>
			</div>
		</div>
		@if($companyTransactions->isNotEmpty())
			<div class="d-flex align-items-center justify-content-center my-3">
				<div class="">
					{{ $companyTransactions->links() }}
				</div>
			</div>	
			<div class="row">
				@foreach($companyTransactions as $transaction)
					@php $date = explode('-', $transaction->transaction_date); @endphp
					@php $tranactionDate = \Carbon\Carbon::createFromDate($date[0], $date[1], $date[2]); @endphp
					<div class="col-12 col-sm-6 col-xl-4 mb-2">
						<div class="indTrans addBoxShadow{{ ' ' .strtolower($transaction->type) }}">
							<div class="indTransHeader">
								<h2 class=""><span class="itemContent">{{ $transaction->type }}</span><span class="indTransactionDate text-muted text-center d-block">{{ $tranactionDate->toFormattedDateString() }}</span></h2>
							</div>
							<div class="indTransInfo">
								<div class="">
									<span class="spanLabel">User Completed:</span>
									<span class="itemContent"><a href="/user/{{ $transaction->user_account->user->id }}/transactions">{{ $transaction->user->firstname }}</a></span>
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
								<div class="mt-4">
									<span class="spanLabel">Description:</span>
									<span class="itemContent">{{ $transaction->description != null ? $transaction->description : 'No Description of This Transaction' }}</span>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="row">
				<div class="col-12">
					<h2 class="">Your company does not have any transactions added yet. Click <a href="/transactions/create" class="">here</a> to create a transaction.</h2>
				</div>
			</div>
		@endif
	</div>
@endsection