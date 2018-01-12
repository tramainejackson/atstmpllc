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
		<div class="col-10 mt-4 mx-auto">
			<div class="userNavLinks d-flex justify-content-around">
				<a href="/bank" class="btn col-12 col-sm-2">All Banks</a>
			</div>
		</div>
		<div class="col-12 col-sm-8 mx-auto">
			<div class="createNewBank">
				<div class="formDiv">
					<div class="formDivTitle row">
						<h2 class="">Create A New Bank</h2>
					</div>
					{!! Form::open(['action' => ['BankAccountController@store'], 'method' => 'POST']) !!}
						<div class="form-group">
							<label class="form-label">Bank Name</label>
							<input type="text" name="bank_name" class="form-control" value="{{ old('bank_name') }}" placeholder="Enter Bank Name" required autofocus />

							@if ($errors->has('bank_name'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('bank_name') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label class="form-label">Account Number</label>
							<input type="text" name="account_num" class="newBankAN form-control" value="" placeholder="Enter Account Number" />
						</div>
						<div class="form-group">
							<label class="form-label">Checking Balance</label>
							<div class="input-group">
								<span class="oi oi-dollar input-group-addon"></span>
								<input type="number" name="checking_balance" class="form-control" value="" placeholder="0.00" step="0.01" />
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Saving Balance</label>
							<div class="input-group">
								<span class="oi oi-dollar input-group-addon"></span>
								<input type="number" name="savings_balance" class="form-control" value="" placeholder="0.00" step="0.01" />
							</div>
						</div>
						<div class="row">
							<input hidden type="text" name="added_by" value="{{ $user_id }}" />
						</div>
						<div class="form-group">
							{{ Form::submit('Create New Bank', ['class' => 'btn btn-lg btn-primary']) }}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection