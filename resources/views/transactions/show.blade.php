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
			<div class="userNavLinks d-flex flex-column flex-lg-row justify-content-around">
				<a href="/transactions" class="btn col-12 col-lg-6">All Transactions</a>
				<a href="/transactions/create" class="btn col-12 col-lg-6">New Transaction</a>
			</div>
		</div>
		<div class="col-12 col-lg-10 mx-auto">
			@if($totalUserTransactions > 0)
				<div class="userTransactionHeader">
					<h2 class="coolText2">All transactions for<br/><span class="">{{ $user_name }}</span></h2>
					<h5 class="mt-0 mb-4 text-muted"><u>Total Transactions:</u>&nbsp;<span><em>{{ $totalUserTransactions }}</em></span></h5>
				</div>
				<div class="row position-relative">
					@foreach($user_transactions as $group_transactions)
						<div class="col-12{{ !$loop->first ? ' mt-4' : '' }}">
							<h1 class="coolText2 p-2{{ !$loop->first ? ' mt-4' : '' }}" style="background: linear-gradient(90deg, #deb887, #ff7f50, #cd5c5c, transparent);"><em>{{ $group_transactions->first()->bank_account->bank_name }} Transactions</em></h1>
						</div>
						@foreach($group_transactions as $transaction)
							@php $date = explode('-', $transaction->transaction_date); @endphp
							@php $tranactionDate = \Carbon\Carbon::createFromDate($date[0], $date[1], $date[2]); @endphp
							<div class="my-2 col-md-4 col-sm-6 col-xs-6">
								<div class="view indTrans addBoxShadow{{ ' ' .strtolower($transaction->type) }}">
									<div class="mask flex-center rgba-black-strong" style="display:none;">
										<p class="white-text">Remove</p>
									</div>
									<div class="indTransHeader">
										<h2><span class="itemContent">{{ $transaction->type }}</span><span class="indTransactionDate text-muted text-center d-block">{{ $tranactionDate->toFormattedDateString() }}</span></h2>
									</div>
									<div class="myTransactionInfo">
										<div class="">
											<span class="spanLabel">Amount:</span>
											<span class="itemContent">{{ "$" . $transaction->amount }}</span>
										</div>
										<div class="">
											<span class="spanLabel">Bank:</span>
											<span>{{ $transaction->bank_account->bank_name }}</span>
										</div>
										
										@if($transaction->type != "Transfer")
											<div class="">
												<span class="spanLabel">Receipt:</span>
												@if($transaction->receipt == "Y")
													<a class="transImg" href="{{ asset('storage/images/' . $transaction->receipt_photo) }}">Receipt Photo</a>
												@else
													<span class="itemContent">{{ $transaction->receipt }}</span>
												@endif
											</div>
										@endif

										@if($transaction->type == "Transfer")
											<div class="">
												<span class="spanLabel">Transfer To:</span>
												@if($transaction->transfer_type == "user")
													@php $toUser = $transaction->bank_account->user_accounts->where('id', $transaction->transfer_to)->first(); @endphp
													<span class="itemContent">{{ $toUser->user->firstname }}</span>
												@else
													<span class="itemContent">{{ ucwords($transaction->transfer_to) }}</span>
												@endif
											</div>
										@endif
										
										<div class="form-check">
											<input type="checkbox" name="removeTransaction[]" class="form-check-input filled-in" value="{{ $transaction->id }}" id="removeCheckbox{{$loop->parent->iteration}}{{$loop->iteration}}" /><label class="form-check-label" for="removeCheckbox{{$loop->parent->iteration}}{{$loop->iteration}}">&nbsp;</label>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					@endforeach
					<div class="">
						<button type="button" class="btn red removeTransBtn invisible" data-toggle="modal" data-target="#transaction_delete_modal">Remove Selected</button>
					</div>
				</div>
			@else
				<div class="emptyAccountHeader">
					<h2 class="">No transactions added for this user.</h2>
				</div>
			@endif
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="transaction_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Remove Transaction(s)</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					{!! Form::open(['action' => ['TransactionController@destroy'], 'method' => 'Delete', 'id' => 'removeTransForm', 'class' => 'row']) !!}
					
						<div class="">
							<button type="submit" class="btn btn-lg indigo">Remove Transactions</button>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection