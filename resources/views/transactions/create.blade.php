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
				<a href="/transactions" class="btn col-12 col-sm-3">All Transactions</a>
			</div>
		</div>
		<div class="col-12 col-sm-8 mx-auto">
			<div class="formDiv">
				@if($userAccounts->isNotEmpty())
					<div class="formDivTitle row">
						<h2 class="">Create New Transaction</h2>
					</div>
					{!! Form::open(['action' => ['TransactionController@store'], 'files' => true, 'method' => 'POST']) !!}
						<div class="formDiv">
							<div class="form-row mb-4">
								<div class="col-12 col-sm-6">
									<label class="form-label">Bank</label>
									<select class="bankSelect form-control custom-select browser-default" name="bank_id">
										<option value="blank" disabled>----- Select a Bank -----</option>
										@if($userAccounts->count() > 0)
											@foreach($userAccounts as $userAccount)
												@php $bankAccount = \App\BankAccount::find($userAccount->bank_account_id); @endphp
													<option value="{{ $bankAccount->id }}">{{ $bankAccount->bank_name . " - $" . number_format($bankAccount->checking_balance, 2) . " (Checking)" }}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="col-12 col-sm-6">
									<label class="form-label">Transaction Type</label>
									<select class="transactionSelect form-control custom-select browser-default" name="type">
										<option value="Purchase" selected>Purchase</option>
										<option value="Deposit">Deposit</option>
										<option value="Withdrawl">Withdrawl</option>
										<option value="Transfer">Transfer</option>
									</select>
								</div>
							</div>
							<!-- <div class="form-group addtDepositForm alternateFormGroups hidden">
								<label class="form-label">Deposit Type</label>
								<select class="form-control" name="deposit_type" disabled>
									<option value="personal" selected>Personal</option>
									<option value="company">Company Income</option>
								</select>
							</div> -->
							<div class="form-group addtWithdrawlForm alternateFormGroups hidden">
								<label class="form-label">Withdrawl Type</label>
								<select class="form-control browser-default" name="withdrawl_type" disabled>
									<option value="personal" selected>Personal</option>
									<option value="company">Company Withdrawl</option>
								</select>
							</div>
							<div class="form-group addtTransferForm alternateFormGroups hidden">
								<label class="form-label">Transfer Type</label>
								<select class="transferAccountType custom-select form-control browser-default" name="transfer_type" disabled>
									<option value="blank" disabled>----- Select a Transfer Type -----</option>
									<option value="account" selected>Account Transfer</option>
									<option value="user">User Transfer</option>
								</select>
							</div>
							<div class="form-group addtDepositForm alternateFormGroups hidden">
								<label class="form-label">Account Type</label>
								<select class="form-control custom-select browser-default" name="account_type" disabled>
									<option value="checking" selected>Checking</option>
									<option value="savings">Savings</option>
								</select>
							</div>
							<div class="form-row addtTransferForm alternateFormGroups hidden">
								<div class="col-12">
									<label class="form-label">Send From</label>
									<select class="form-control custom-select sendFromUserSelect browser-default" name="transfer_from" disabled>
										<option value="blank" class="firstOption" disabled>---- Select Account To Send From ----</option>
										@if($userAccounts->count() > 0)
											@foreach($userAccounts as $userAccount)
												@php $bankAccount = \App\BankAccount::find($userAccount->bank_account_id); @endphp
													<option value="{{ $bankAccount->id . 'c' }}" class="{{ !$loop->first ? 'hidden' : ''}}"{{ $loop->first ? ' selected' : ''}}>{{ "Checking" . " - $" . number_format($bankAccount->checking_balance, 2) }}</option>
													<option value="{{ $bankAccount->id . 's' }}" class="{{ !$loop->first ? 'hidden' : ''}}">{{ "Savings" . " - $" . number_format($bankAccount->savings_balance, 2) }}</option>
													<option value="{{ $bankAccount->id . 'm' }}" class="hidden">{{ "My Bank Share - $" . number_format($userAccount->checking_share, 2) }}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="col-12">
									<label class="form-label">Send To</label>
									<select class="form-control custom-select sendToUserSelect browser-default" name="transfer_to" disabled>
										<option value="blank" class="firstOption" disabled>---- Select Account To Send To ----</option>
										@if($userAccounts->count() > 0)
											@foreach($userAccounts as $userAccount)
												@php $bankAccount = \App\BankAccount::find($userAccount->bank_account_id); @endphp
													<option value="{{ $bankAccount->id . 'c' }}" class="accountOption{{ !$loop->first ? ' hidden' : ''}}"{{ $loop->first ? ' selected' : ''}}>{{ "Checking" . " - $" . number_format($bankAccount->checking_balance, 2) }}</option>
													<option value="{{ $bankAccount->id . 's' }}" class="accountOption{{ !$loop->first ? ' hidden' : ''}}">{{ "Savings" . " - $" . number_format($bankAccount->savings_balance, 2) }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
							<div class="form-group{{ $errors->has('trans_amount') ? ' has-error' : '' }}">
								<label class="form-label">Amount</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="oi oi-dollar input-group-text"></span>
									</div>
									<input type="number" name="trans_amount" title="Remeber to add the cents." class="balanceInput transAmount form-control" value="" placeholder="0.00" step="0.01" />
								</div>
								
								@if ($errors->has('trans_amount'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('trans_amount') }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group">
								<label for="description" class="form-label">Description</label>
								<textarea name="description" class="form-control" placeholder="Enter A Description of The Transaction">{{ old('description') }}</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Date</label>
								<input type="text" name="trans_date" class="form-control datetimepicker" value="" placeholder="Select Transaction Date" />
								
								@if ($errors->has('trans_date'))
									<span class="help-block text-danger">
										<strong>Transaction date is required</strong>
									</span>
								@endif
							</div>
							<div class="form-row receiptForm">
								<div class="col-12 col-sm-6">
									<label class="form-label">Receipt</label>
									<select class="form-control custom-select browser-default" name="receipt">
										<option value="Y">Yes</option>
										<option value="N">No</option>
									</select>
								</div>
								<div class="col-12 col-sm-6">
									<label class="form-label">Receipt Photo</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Upload</span>
										</div>
										<div class="custom-file">
											<input type="file" name="receipt_photo[]" class="custom-file-input" value="" placeholder="" multiple />
											<label class="custom-file-label" for="inputGroupFile02">Choose file</label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">User</label>
								<input disabled type="text" name="trans_user" class="form-control" value="{{ $user->firstname }}" />
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