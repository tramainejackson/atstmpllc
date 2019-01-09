@extends('layouts.app')

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
								<h1 class="coolText2 text-center text-sm-left text-underline p-2{{ !$loop->first ? ' mt-4' : '' }}">{{ $group_transactions->first()->bank_account->bank_name }} Transactions</h1>
							</div>

							@foreach($group_transactions as $transaction)

								<div class="my-2 col-md-4 col-sm-6 col-xs-6">

									<div class="view indTrans addBoxShadow{{ ' ' .strtolower($transaction->type) }}">

										<div class="mask flex-center rgba-black-strong" style="display:none;">
											<p class="white-text">Remove</p>
										</div>

										<div class="indTransHeader">
											<h2><span class="itemContent">{{ $transaction->type }}</span><span class="indTransactionDate text-muted text-center d-block">{{ $transaction->transaction_date->format('m/d/Y') }}</span></h2>
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

		@include('modals.delete_transaction')

	</div>

@endsection