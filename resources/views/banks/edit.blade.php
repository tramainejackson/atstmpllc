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
		<div class="col-12 col-sm-10 my-4 mx-auto">
			<div class="userNavLinks row d-flex justify-content-around">
				<a href="/bank" class="btn col-5 col-sm-2 my-1">All Banks</a>
				<a href="/bank/create" class="btn col-5 col-sm-2 my-1">Add A New Bank</a>
				<a class="btn col-5 col-sm-2 my-1" href="/bank/{{ $bankAccount->id }}/users" class="">Edit Bank Users</a>
				<a class="btn btn-danger col-5 col-sm-2 my-1 removeBank" href="#{{ $bankAccount->id }}" class="">Remove Bank</a>
			</div>
		</div>
		<div class="col-12 col-sm-8 mx-auto">
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
								<div class="input-group-prepend">
									<span class="oi oi-dollar input-group-text"></span>
								</div>
								<input type="number" name="checking_balance" class="form-control" value="{{ $bankAccount->checking_balance }}" placeholder="Enter Checking Balance" step="0.01"/>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Saving Balance</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="oi oi-dollar input-group-text"></span>
								</div>
								<input type="number" name="savings_balance" class="form-control" value="{{ 		$bankAccount->savings_balance }}" placeholder="Enter Savings Balance" step="0.01" />
							</div>
						</div>
						<div class="form-group">
							<input hidden type="text" name="bank_id" value="{{ $bankAccount->id }}" />
						</div>
						<div class="form-group">
							{{ Form::submit('Update Bank', ['class' => 'btn btn-outline-success']) }}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<div class="row my-5">
		<div class="col-12 mx-auto">
			<h2 class="">Bank User</h2>
		</div>
		@foreach($bankUsers as $bankUser)
			<div class="col-12 col-xl-3 my-2">
				<!-- Card Wider -->
				<div class="card card-cascade wider">
					<!-- Card image -->
					<div class="view overlay">
						<img src="{{ $bankUser->user->picture != null ? asset('/storage/images/' . $bankUser->user->picture) : '/images/emptyface.jpg' }}" class="img-fluid imgPreview mx-auto" alt="Profile Photo" />
					</div>
					<!-- /Card image -->
				
					<!-- Card content -->
					<div class="card-body">
						<div class="nameHeader text-center">
							<h2 class="coolText1 mb-4">{{ $bankUser->user->full_name() }}</h2>
						</div>
						<div class="userAccountInfo">
							<p class=""><em><u>Checking Share:</u></em>&nbsp;${{ number_format($bankUser->checking_share, 2, '.', ',') }}</p>
							<p class=""><em><u>Savings Share:</u></em>&nbsp;${{ number_format($bankUser->savings_share, 2, '.', ',') }}</p>
							<p class=""><em><u>Share Percent:</u></em>&nbsp;{{ ($bankUser->share_pct * 100) }}%</p>
							<p class=""><em><u>Can Edit Bank:</u></em>&nbsp;{{ $bankUser->edit_bank }}</p>
						</div>
					</div>
					<!-- Card content -->
				</div>
				<!-- Card Wider -->
			</div>
		@endforeach
	</div>
	<div class="row mb-5">
		<div class="col-12 mx-auto">
			<h2 class="">Bank Transactions</h2>
		</div>
		
		@foreach($bankTransactions as $transaction)
			@php $transDate = new Carbon\Carbon($transaction->transaction_date); @endphp
			<div class="col-12 col-xl-4 my-2">
				<div class="card card-cascade narrower">
					<div class="indTransaction view gradient-card-header blue-gradient {{ strtolower($transaction->type) }}">
						<h2 class="">{{ $transaction->type }}</h2>
						<span class="transactionDate"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;&nbsp;{{ $transDate->format('m/d/Y') }}</span>
					</div>
					<div class="myTransactionInfo card-body text-center {{ $transaction->type }}">
						<div class="">
							<span class="spanLabel">Amount:</span>
							<span class="itemContent">{{ "$" . $transaction->amount }}</span>
						</div>
						@if($transaction->type != "Transfer")
							<div class="">
								<span class="spanLabel">Receipt:</span>
								@if($transaction->receipt == "Y")
									<a class="transImg" href="{{ $transaction->receipt_photo != null ? asset('/storage/images/' . $transaction->receipt_photo) : '/images/emptyface.jpg' }}">Receipt Photo</a>
								@else
									<span class="itemContent">{{ $transaction->receipt }}</span>
								@endif
							</div>
						@endif
						@if($transaction->type == "Transfer")
							<div class="">
								<span class="spanLabel">Transfer To:</span>
								@if($transaction->transfer_type == "user")
									@php $toUser = \App\UserAccount::find($transaction->transfer_to); @endphp
									<span class="itemContent">{{ $toUser->user->firstname }}</span>
								@else
									<span class="itemContent">{{ ucwords($transaction->transfer_to) }}</span>
								@endif
							</div>
						@endif
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
@endsection