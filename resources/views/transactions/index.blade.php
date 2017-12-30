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
		<div class="col-12 col-xl-8 mx-auto">
			<div class="row">
				<div class="col-12">
					<h2 class="mb-4 text-muted">{{ $user->company->company_name }} Transactions</h2>
				</div>
				
				@if($companyTransactions->isNotEmpty())
					<div class="row">
						@if(!empty($companyTransactions))
							@if($companyTransactions->count() > 0)
								@foreach($companyTransactions as $transaction)
									<div class="col-md-4 col-sm-6 col-xs-6">
										<div class="indTrans addBoxShadow{{ ' ' .strtolower($transaction->type) }}">
											<div class="indTransHeader">
												<h2 class=""><span class="itemContent">{{ $transaction->type }}</span><span class="indTransactionDate">{{ $transaction->date }}</span></h2>
											</div>
											<div class="indTransInfo">
												<div class="">
													<span class="spanLabel">User Completed:</span>
													<span class="itemContent"><a href="/transactions{{ $transaction->user_id }}/edit }}">{{ $transaction->user }}</a></span>
												</div>
												<div class="">
													<span class="spanLabel">Amount:</span>
													<span class="itemContent">{{ "$" . $transaction->amount }}
												@if($transaction->type != "Transfer")
													<div class="">
														<span class="spanLabel">Receipt:</span>
														@if($transaction[$i]->receipt == "Y")
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
															<span class="itemContent">{{ $toUser->firstname }}</span>
														@else
															<span class="itemContent">{{ ucwords($transaction->transfer_to) }}</span>
														@endif
													</div>
												@endif
											</div>
										</div>
									</div>
								@endforeach
							@endif
						@else
							<div class="emptyAccountHeader">
								<h2 class="">You do not have any recent transactions added.</h2>
							</div>
						@endif
					</div>
						
				@else
					<div class="col-12">
						<h2 class="">Your company does not have any transactions added yet. Click <a href="/transactions/create" class="">here</a> to create a transaction.</h2>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection