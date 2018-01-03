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
				<a href="/users" class="btn col-3">Edit Bank Users</a>
			</div>
		</div>
		<div class="col-8 mx-auto">
			<div class="formDiv">
				{!! Form::open(['action' => ['UserAccountController@store', $bankAccount->id], 'method' => 'POST']) !!}
					<div class="formDivTitle row">
						<h2 class=""> {{ $bankAccount->bank_name }} - Add New User</h2>
					</div>
					<div class="form-group">
						@if($company_users->count() > 1)
							<label class="form-label">Select User To Add</label>
							<select class="custom-select form-control" name="user_id">
								@foreach($company_users as $company_user)
									<option value="{{ $company_user->id }}" {{ $company_user->id == Auth::id() || $company_user->user_accounts()->where('bank_account_id', $bankAccount->id)->first() ? 'disabled' : '' }}>{{ $company_user->firstname . ' ' . $company_user->lastname}}{{ $company_user->id == Auth::id() || $company_user->user_accounts()->where('bank_account_id', $bankAccount->id)->first() ? ' - has an active account' : '' }}</option>
								@endforeach
							</select>
						@else
							<h4 class="text-muted text-center">There are no other users to add. Click here to add a new <a href="/users">user</a> to your company/business</h4>
						@endif
					</div>
					<div class="form-group">
						<label class="form-label">Can edit bank</label>
						<select class="custom-select form-control" name="edit_bank">
								<option value="Y">Yes</option>
								<option value="N">No</option>
						</select>
					</div>
					<div class="form-group">
						{{ Form::submit('Add User', ['class' => 'btn btn-lg btn-primary']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection