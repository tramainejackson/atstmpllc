@extends('layouts.app')

@section('styles')
	@include('layouts.styles.bootstrap_css')
	<style>
		/* Carousel*/
		.carousel,
		.carousel-item,
		.carousel-item.active {
		  height: 100%;
		}
		.carousel-inner {
		  height: 100%;
		}
		.carousel-item:nth-of-type(odd) {
		  background-image: url('{{ asset('/images/bank_image.jpg') }}');
		  background-repeat: no-repeat;
		  background-size: cover;
		  background-position: center center;
		}
		.carousel-item:nth-of-type(even) {
		  background-image: url('{{ asset('/images/bank_image_2.jpg') }}');
		  background-repeat: no-repeat;
		  background-size: cover;
		  background-position: center center;
		}
	</style>
@endsection

@section('scripts')
	@include('layouts.functions.bootstrap_js')
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col">
			@include('layouts.nav')
		</div>
	</div>
    <div class="row">
		<div class="col-12 col-md-12 col-lg-12 col-xl-4 text-center mx-auto my-5">
			<!-- Card Wider -->
			<div class="card card-cascade wider">
				<!-- Card image -->
				<div class="view overlay">
					<img src="{{ $user->picture != null ? asset('/storage/images/' . $user->picture) : '/images/emptyface.jpg' }}" class="img-fluid imgPreview mx-auto" alt="Profile Photo" />
				</div>
				<!-- /Card image -->
			
				<!-- Card content -->
				<div class="card-body">
					<div class="nameHeader">
						<h2 class="coolText1">{{ $user->full_name() }}</h2>
					</div>
					<div class="lastLogin mb-3">
						<span class="blue-text">Last Login: {{ $last_login->toFormattedDateString() }}</span>
					</div>
					
					{!! Form::open(['action' => ['HomeController@update_image', 'user' => $user->id], 'files' => true, 'method' => 'PUT']) !!}
						<div class="row m-0 d-flex justify-content-center">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Upload</span>
								</div>
								<div class="custom-file">
									<input type="file" class="btn col-4 custom-file-input" name="profile_img" id="customFile" />
									<label for="customFile" class="custom-file-label text-left">Change Photo</label>
								</div>
							</div>
							<div class="form-group my-2">
								<input type="submit" class="btn hidden blue-gradient profile_img_submit" name="submit" value="Save New Picture" />
							</div>
						</div>
					{!! Form::close() !!}
				</div>
				<!-- Card content -->
			</div>
			<!-- Card Wider -->
		</div>
		
		<!-- Bank Accounts -->
		<div class="col-12">
			<div class="row">
				<h1 class="col">Banks</h1>				

				<div class="col text-right">
					<a class="btn btn-info" href="/bank/create">Add A Bank</a>
				</div>

				<div class="col-12">
					<span>Here's a list of all your banks</span>
				</div>
			</div>
		</div>
		<div class="bankAccounts container-fluid">

			<!-- Carousel Wrapper -->
			<div id="bank_carousel" class="carousel slide carousel-fade" data-ride="carousel">
				<div class="carousel-inner" role="listbox">
					@if($user_accounts)
						@foreach($user_accounts as $user_account)
							<!--Slides-->
								<div class="carousel-item{{ $loop->first ? ' active' : '' }}">
									<div class="view">
										<div class="full-bg-img flex-center mask white-text{{ fmod($loop->iteration, 2) != 0 ? ' rgba-blue-light' : ' rgba-brown-light' }}">
											<div class="bankCount rgba-black-strong p-2 m-2 rounded-circle">
												<span>{{ $loop->iteration }}/{{ $loop->count }}</span>
											</div>
											<div class="col-5 text-center">
												<!-- Bank Accounts -->
												<div class="align-items-center bankAccountHeader d-flex justify-content-between w-100">
													<h2 class="coolText5" style="width: max-content">{{ $user_account->bank_account->bank_name }}</h2>
													@if($user_account->edit_bank == "Y")
														<a href="/bank/{{ $user_account->bank_account->id }}/edit" class="btn btn-secondary">Edit Bank Account</a>
													@else
														<div class="">
															<p class="">You have not been granted permissions to view this banks information</p>
														</div>
													@endif
												</div>
												<div class="bankAccountInfo border rounded mb-3">
													<h4 class="text-left coolText5 p-3"><u>Bank Balances:</u></h4>
													<div class="">
														<span class="spanLabel">Checking Balance:</span>
														<span class="itemContent">{{ $user_account->bank_account->checking_balance != null ? '$' . number_format($user_account->bank_account->checking_balance, 2) : '$0.00' }}</span>
													</div>
													<div class="">
														<span class="spanLabel">Savings Balance:</span>
														<span class="itemContent">{{ $user_account->bank_account->savings_balance != null ? '$' . number_format($user_account->bank_account->savings_balance, 2) : '$0.00' }}</span>
													</div>
												</div>
												<!-- /Bank Accounts -->

												<!-- User Accounts -->
												<div class="myAccountInfo border rounded">
													<h4 class="text-left coolText5 p-3"><u>My Balances:</u></h4>
													<div class="">
														<span class="spanLabel">My balance within checking account:</span>
														<span class="itemContent">{{ $user_account->checking_share != null ? '$' . number_format($user_account->checking_share, 2) : '$0.00' }}</span>
													</div>
													<div class="">
														<span class="spanLabel">My balance within savings account:</span>
														<span class="itemContent">{{ $user_account->savings_share != null ? '$' . number_format($user_account->savings_share, 2) : '$0.00' }}</span>
													</div>
													<div class="">
														<span class="spanLabel">Ownership of Account:</span>
														<span class="itemContent">{{ ($user_account->share_pct * 100) . "%" }}</span>
													</div>
												</div>
												<!-- /User Accounts -->
											</div>
										</div>
									</div>
								</div>
						@endforeach
						
						@if($user_accounts->count() > 1)
							<!--Controls-->
							<a class="carousel-control-prev" href="#bank_carousel" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#bank_carousel" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
							<!--/.Controls-->
						@endif
					@else
						<div class="emptyAccountHeader">
							<h2 class="">You do not currently have any accounts added.</h2>
						</div>
					@endif
				</div>
			</div>
			<!-- /Carousel Wrapper-->
		</div>
		<!-- /Bank Accounts -->

		<!-- User Most Recent Transactions -->
		<div class="myTransactions container-fluid px-3">
			<div class="row mb-2">
				<div class="col-12 col-xl-8">
					<h1 class="">My Recent Transactions</h1>
				</div>
				<div class="col-12 col-xl-2">
					<a class="btn btn-info d-block text-truncate" href="/transactions/create">Create</a></button>
				</div>
				<div class="col-12 col-xl-2">
					<a class="btn btn-info d-block text-truncate" href="/transactions/">View All</a></button>
				</div>
			</div>
			<div class="row">
				@if($transactions->count() > 0)
					@foreach($transactions as $transaction)
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
				@else
					<div class="emptyAccountHeader col-md-12">
						<h2 class="">You do not have any recent transactions added.</h2>
					</div>
				@endif
			</div>
		</div>
		<!-- /User Most Recent Transactions -->
	</div>
</div>
@endsection
