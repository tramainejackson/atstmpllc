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
		<div class="col-12 my-4">
			<h2 class="text-muted">{{ $bankAccount->bank_name }} Bank Users</h2>
		</div>
		<div class="col-10 mx-auto">
			<div class="userNavLinks d-flex flex-column flex-sm-row justify-content-around">
				<a href="/bank" class="btn col-12 my-1 col-sm-2">All Banks</a>
				<a href="/bank/create" class="btn col-12 my-1 col-sm-2">Add A New Bank</a>
				<a class="btn col-12 my-1 col-sm-2 editBankLink text-truncate" href="/account/create/{{ $bankAccount->id }}">Add Bank User</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-8 mx-auto my-4">
			<div class="formDiv">
				<div class="formDivTitle">
					<h2 class="">Edit Bank Users</h2>
				</div>
				{!! Form::open(['action' => ['UserAccountController@update', $bankAccount->id], 'method' => 'PUT']) !!}
					@if($bank_accounts->count() > 1)
						@foreach($bank_accounts as $bank_account)
							<div class="form-row mb-3">
								<div class="col-12 col-sm-5">
									<label class="form-label">User</label>
									<input class="form-control" name="" value="{{ $bank_account->user->firstname . ' ' . $bank_account->user->last_name }}" disabled />
									<input hidden type="number" name="user[]" class="" value="{{ $bank_account->id }}" />
								</div>
								<div class="col-12 col-sm-3">
									<label class="form-label">Can Edit Bank</label>
									<select class="form-control custom-select" name="edit_bank[]">
										<option value="Y" {{ $bank_account->edit_bank == 'Y' ? 'selected' : ''}}>Yes</option>
										<option value="N"  {{ $bank_account->edit_bank == 'N' ? 'selected' : ''}}>No</option>
									</select>
								</div>
								<div class="col-12 col-sm-2">
									<label class="form-label">Ownership</label>
									<div class="input-group">
										<input type="number" name="ownership[]" class="form-control" value="{{ $bank_account->share_pct * 100 > 0 ? number_format($bank_account->share_pct * 100, 2) : '' }}" placeholder="Add Owrnership %" step="0.01" />
										<span class="input-group-addon" id="">%</span>
									</div>
								</div>
								<div class="col-12 col-sm-2">
									<label class="form-label">&nbsp;</label>
									<a href="#{{ $bank_account->id }}" class="btn btn-danger{{ $bank_account->user->id == Auth::id() ? ' disabled' : ' removeBankUser' }}">Remove From Bank</a>
								</div>
							</div>
						@endforeach
					@else
						<p class="text-center">No other users have an account for this bank</p>
					@endif
					<div class="form-group">
						@if($bank_accounts->count() > 1)
							{{ Form::submit('Update Users', ['class' => 'btn btn-lg btn-primary']) }}
						@else
							<div class="my-2">
								<a href="/account/create/{{ $bankAccount->id }}" class="btn btn-lg btn-primary">Add User To Bank</a>
							</div>
						@endif
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection