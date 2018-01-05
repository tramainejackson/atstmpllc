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
				<a href="/bank" class="btn col-2">All Banks</a>
			</div>
		</div>
		<div class="col-12">
			<h2 class="text-muted">{{ $bankAccount->bank_name }} Bank Users</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-8 mx-auto">
			<div class="formDiv">
				<div class="formDivTitle row">
					<h2 class="">Edit Bank Users</h2>
				</div>
				{!! Form::open(['action' => ['BankAccountController@store'], 'method' => 'POST']) !!}
					@if($bank_accounts->count() > 1)
						@foreach($bank_accounts as $bank_account)
							<div class="form-row">
								<div class="col">
									<label class="form-label">User</label>
									<input class="form-control" name="" value="{{ $bank_account->user->firstname }}" />
								</div>
								<div class="col">
									<label class="form-label">Can Edit Bank</label>
									<select class="form-control custom-select" name="">
										<option value="Y" {{ $bank_account->edit_bank == 'Y' ? 'selected' : ''}}>Yes</option>
										<option value=""  {{ $bank_account->edit_bank == 'N' ? 'selected' : ''}}>No</option>
									</select>
								</div>
							</div>
						@endforeach
					@else
						<option class="userOption">No other users have an account for this bank</option>
					@endif
					<div class="form-group">
						{{ Form::submit('Create New Bank', ['class' => 'btn btn-lg btn-primary']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection