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
				<a href="/bank" class="btn col-3">All Banks</a>
				<a href="/bank/create" class="btn col-3">Add A New Bank</a>
			</div>
		</div>
		<div class="col-8 mx-auto">
			<div class="editBank">
				<div class="formDiv">
					{!! Form::open(['action' => ['BankAccountController@update', $bankAccount->id], 'method' => 'PUT']) !!}
						<div class="formDivTitle">
							<h2 class="">Edit Bank Information</h2>
						</div>
						<div class="form-group">
							<label class="form-label">Bank Name</label>
							<input type="text" name="bank_name" class="form-control" value="{{ $bankAccount->bank_name }}" placeholder="Enter Bank Name" />
						</div>
						<div class="form-group">
							<label class="form-label">Account Number</label>
							<input type="text" name="account_num" class="form-control" value="{{ $bankAccount->account_num }}" placeholder="Enter Account Number" />
						</div>
						<div class="form-group">
							<label class="form-label">Checking Balance</label>
							<div class="input-group">
								<span class="oi oi-dollar input-group-addon"></span>
								<input type="number" name="checking_balance" class="form-control" value="{{ number_format($bankAccount->checking_balance, 2) }}" placeholder="Enter Checking Balance" step="0.01"/>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Saving Balance</label>
							<div class="input-group">
								<span class="oi oi-dollar input-group-addon"></span>
								<input type="number" name="savings_balance" class="form-control" value="{{ 		number_format($bankAccount->savings_balance, 2) }}" placeholder="Enter Savings Balance" step="0.01" />
							</div>
						</div>
						<div class="form-group">
							<input hidden type="text" name="bank_id" value="{{ $bankAccount->id }}" />
						</div>
						<div class="bankUsers">
							@foreach($editBankUsers as $editBankUser)
								@php $bankUser = \App\User::find($editBankUser->user_id); @endphp
								<div class="editBankUser">
									<div class="formDivTitle">
										<h2 class="">Edit Users Information</h2>
									</div>
									<div class="form-row">
										<div class="col">
											<label class="form-label">User</label>
											<input type="text" name="user" class="form-control" value="{{ $bankUser->firstname }}" placeholder="" {{ Auth::id() == $editBankUser->user_id ? 'disabled' : '' }} />
										</div>
										<div class="col">
											<label class="form-label">Can Edit Bank</label>
											@if($bankUser->editable == "Y")
												<select class="custom-select form-control" name="edit_bank[]" {{ Auth::id() == $editBankUser->user_id ? 'disabled' : ''}}>
													@if($editBankUser->edit_bank == "Y")
														<option value="Y" selected>Yes</option>
														<option value="N">No</option>
													@else
														<option value="Y">Yes</option>
														<option value="N" selected>No</option>
													@endif
												</select>
											@else
												<select class="custom-select form-control" name="show_bank[]" disabled>
													<option value="admin">Administrator</option>
												</select>
											@endif
										</div>
									</div>
									<div hidden class="">
										@if($bankUser->editable == "Y")
											<input type="text" name="user_account_id[]" class="form-control" value="{{ $editBankUser->user_account_id }}" placeholder="" />
										@endif
									</div>
								</div>
							@endforeach
						</div>
						<div class="form-group">
							{{ Form::submit('Update All', ['class' => 'form-control btn btn-outline-success']) }}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection