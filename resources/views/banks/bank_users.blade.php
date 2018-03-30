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
			<div class="col-10 col-lg-12 mx-auto">
				<div class="userNavLinks d-flex flex-column flex-lg-row justify-content-around">
					<a href="/bank" class="btn col-12 col-lg-3 my-1 mx-0">All Banks</a>
					<a href="/bank/create" class="btn col-12 col-lg-3 my-1 mx-0">Add A New Bank</a>
					<a class="btn col-12 col-lg-3 my-1 mx-0 editBankLink text-truncate" href="/account/create/{{ $bankAccount->id }}">Add Bank User</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-10 mx-auto my-4">
				<div class="formDiv">
					<div class="formDivTitle">
						<h2 class="">Edit Bank Users</h2>
					</div>
					{!! Form::open(['action' => ['UserAccountController@update', $bankAccount->id], 'method' => 'PUT']) !!}
						@if($bank_accounts->count() > 1)
							@foreach($bank_accounts as $bank_account)
								<div class="form-row mb-3">
									<div class="col-12">
										<label class="form-label">User</label>
										<input class="form-control" name="" value="{{ $bank_account->user->full_name() }}" disabled />
										<input hidden type="number" name="user[]" class="" value="{{ $bank_account->id }}" />
									</div>
									<div class="col-12">
										<label class="form-label">Can Edit Bank</label>
										<select class="form-control custom-select browser-default" name="edit_bank[]">
											<option value="Y" {{ $bank_account->edit_bank == 'Y' ? 'selected' : ''}}>Yes</option>
											<option value="N"  {{ $bank_account->edit_bank == 'N' ? 'selected' : ''}}>No</option>
										</select>
									</div>
									<div class="col-12">
										<label class="form-label">Ownership</label>
										<div class="input-group">
											<input type="number" name="ownership[]" class="form-control" value="{{ $bank_account->share_pct * 100 > 0 ? number_format($bank_account->share_pct * 100, 2) : '' }}" placeholder="Add Owrnership %" step="0.01" />
											<div class="input-group-append">
												<i class="fa fa-percent input-group-text" aria-hidden="true"></i>
											</div>
										</div>
									</div>
									<div class="col-12">
										<label class="form-label d-none">&nbsp;</label>
										<a href="#{{ $bank_account->id }}" class="btn btn-block btn-danger mt-2 mb-4{{ $bank_account->user->id == Auth::id() ? ' disabled' : ' removeBankUser' }}">Remove From Bank</a>
									</div>
								</div>
							@endforeach
						@else
							<p class="text-center">No other users have an account for this bank</p>
						@endif
						<div class="md-form">
							@if($bank_accounts->count() > 1)
								{{ Form::submit('Update Users', ['class' => 'btn btn-lg btn-primary mx-0']) }}
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
	</div>
@endsection