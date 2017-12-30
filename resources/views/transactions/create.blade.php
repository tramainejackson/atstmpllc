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
			<div class="formDiv">
				@if($userAccounts->isNotEmpty())
					<div class="formDivTitle row">
						<h2 class="">Create New Transaction</h2>
					</div>
					{!! Form::open(['action' => ['TransactionController@store'], 'files' => true, 'method' => 'POST']) !!}
						<div class="formDiv">
							<div class="form-row mb-4">
								<div class="col-6">
									<label class="form-label">Bank</label>
									<select class="bankSelect form-control custom-select" name="bank_id">
										<option value="blank" selected disabled>----- Select a Bank -----</option>
										@if($userAccounts->count() > 0)
											@foreach($userAccounts as $userAccount)
												@php $bankAccount = \App\BankAccount::find($userAccount->bank_account_id); @endphp
													<option value="{{ $bankAccount->id }}">{{ $bankAccount->bank_name . " - $" . number_format($bankAccount->checking_balance, 2) }}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="col-6">
									<label class="form-label">Transaction Type</label>
									<select class="transactionSelect form-control custom-select" name="type">
										<option value="Purchase" selected>Purchase</option>
										<option value="Transfer">Transfer</option>
										<option value="Deposit">Deposit</option>
										<option value="Withdrawl">Withdrawl</option>
										<option value="Refund">Refund</option>
									</select>
								</div>
							</div>
							<div class="form-group addtDepositForm alternateFormGroups" style="display:none;">
								<label class="form-label">Deposit Type</label>
								<select class="form-control" name="deposit_type">
									<option value="personal" selected>Personal</option>
									<option value="company">Company Income</option>
								</select>
							</div>
							<div class="form-group addtWithdrawlForm alternateFormGroups" style="display:none;">
								<label class="form-label">Withdrawl Type</label>
								<select class="form-control" name="withdrawl_type">
									<option value="personal" selected>Personal</option>
									<option value="company">Company Withdrawl</option>
								</select>
							</div>
							<div class="form-group addtTransferForm alternateFormGroups" style="display:none;">
								<label class="form-label">Transfer Type</label>
								<select class="transferAccountType custom-select form-control" name="transfer_type">
									<option value="blank" disabled>----- Select a Transfer Type -----</option>
									<option value="account" selected>Account Transfer</option>
									<option value="user">User Transfer</option>
								</select>
							</div>
							<div class="form-group addtTransferForm alternateFormGroups" style="display:none;">
								<label class="form-label">Account Type</label>
								<select class="form-control custom-select" name="account_type">
									<option value="checking" selected>Checking</option>
									<option value="savings">Savings</option>
								</select>
							</div>
							<div class="form-group addtTransferForm alternateFormGroups" style="display:none;">
								<label class="form-label">Send From</label>
								<select class="form-control custom-select" name="account_type">
									<option value="blank" disabled>---- Select Account To Send From ----</option>
									<option value="checking" selected>Checking</option>
									<option value="savings">Savings</option>
								</select>
							</div>
							<div class="form-group addtTransferForm alternateFormGroups" style="display:none;">
								<label class="form-label">Send To</label>
								<select class="form-control custom-select" name="transfer_to">
									<option value="blank" disabled>---- Select Account To Send To ----</option>
									<option value="account_checking">Checking</option>
									<option value="account_savings" selected>Savings</option>
									
									@php 
										$toUsers = \App\User::where([
											['id', '<>', Auth::id()],
											['company_id', $user->company_id]
										])->get(); 
									@endphp
									@if($toUsers->isNotEmpty())
										@foreach($toUsers as $toUser)
											<option value="" disabled>{{ $toUser->firstname }}</option>
										@endforeach
									@else
										<option value="" disabled>No other user available to send to</option>
									@endif
								</select>
							</div>
							<div class="form-group">
								<label class="form-label">Amount</label>
								<div class="input-group">
									<span class="oi oi-dollar input-group-addon"></span>
									<input type="number" name="trans_amount" title="Remeber to add the cents." class="balanceInput transAmount form-control" value="" placeholder="0.00" step="0.01" />
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Date</label>
								<input type="text" name="trans_date" class="form-control datetimepicker" value="" required />
							</div>
							<!-- If not a transfer -->
								<div class="form-row">
									<div class="col-6">
										<label class="form-label">Receipt</label>
										<select class="form-control custom-select" name="receipt">
											<option value="Y">Yes</option>
											<option value="N">No</option>
										</select>
									</div>
									<div class="col-6">
										<label class="form-label">Receipt Photo</label>
										<input type="file" name="receipt_photo" class="form-control" value="" placeholder="" />
									</div>
								</div>
							<!-- -->
							<div class="form-group">
								<label class="form-label">User</label>
								<input disabled type="text" name="trans_user" class="form-control" value="{{ $user->firstname }}" />
								<input hidden type="text" name="user_id" class="" value="{{ $user->user_id }}" />
							</div>
							<div class="form-group">
								{{ Form::submit('Create New Transaction', ['class' => 'btn btn-lg btn-primary']) }}
							</div>
						</div>
					{!! Form::close() !!}
				@else
					<div class="addTrans formDiv">
						<div class="">
							<h2 class="">You do not have any accounts added yet. Click <a href="/bank" class="">here</a> to add an account.</h2>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection