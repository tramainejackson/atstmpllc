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
		<div class="col-10 my-4 mx-auto">
			<div class="userNavLinks d-flex justify-content-around">
				<a href="/bank" class="btn col-2">All Banks</a>
				<a href="/bank/create" class="btn col-2">Add A New Bank</a>
				<a class="btn col-2" href="/bank/{{ $bankAccount->id }}/users" class="">Edit Bank Users</a>
				<a class="btn btn-danger col-2" href="bank.php?create_share={{ $bankAccount->id }}" class="">Remove Bank</a>
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
								<input type="number" name="checking_balance" class="form-control" value="{{ $bankAccount->checking_balance }}" placeholder="Enter Checking Balance" step="0.01"/>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Saving Balance</label>
							<div class="input-group">
								<span class="oi oi-dollar input-group-addon"></span>
								<input type="number" name="savings_balance" class="form-control" value="{{ 		$bankAccount->savings_balance }}" placeholder="Enter Savings Balance" step="0.01" />
							</div>
						</div>
						<div class="form-group">
							<input hidden type="text" name="bank_id" value="{{ $bankAccount->id }}" />
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