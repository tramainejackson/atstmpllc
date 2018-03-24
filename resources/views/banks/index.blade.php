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
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<h2 class="text-muted">My Available Banks</h2>
						<div class="userNavLinks d-flex justify-content-around">
							<a href="/bank/create" class="btn col-sm-2 col-12">Add A New Bank</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row align-items-stretch">
		@if($userAccounts->count() > 0)
			@foreach($userAccounts as $userAccount)
				<div class="col-sm-6 col-12 my-3">	
					@php $bankAccount = \App\BankAccount::find($userAccount->bank_account_id); @endphp
					@if($userAccount->edit_bank == "Y")
						<div class="view">
							<img src="{{ asset('/images/bank_image_3.jpg') }}" class="img-fluid" alt="" />
							<div class="mask d-flex align-items-stretch justify-content-around py-2 rgba-grey-strong white-text">
								<div class="d-flex flex-column justify-content-center">
									<div class="bankAccountHeader">
										<h1 class="coolText5">{{ $bankAccount->bank_name}}</h1>
									</div>
									<div class="bankAccountInfo">
										<div class="py-2">
											<div class="">
												<h3 class="">Checking: </h3>
											</div>
											<div class="">
												<span class="spanLabel">Balance:</span>
												<span class="itemContent">{{ "$" . number_format($bankAccount->checking_balance, 2) }}</span>
											</div>
											<div class="">
												<span class="spanLabel">My Share:</span>
												<span class="itemContent">{{ "$" . number_format($userAccount->checking_share, 2) }}</span>
											</div>
										</div>
										<div class="py-2">
											<div class="">
												<h3 class="">Saving: </h3>
											</div>
											<div class="">
												<span class="spanLabel">Balance:</span>
												<span class="itemContent">{{ "$" . number_format($bankAccount->savings_balance, 2) }}</span>
											</div>
											<div class="">
												<span class="spanLabel">My Share:</span>
												<span class="itemContent">{{ "$" . number_format($userAccount->savings_share, 2) }}</span>
											</div>
										</div>
										<div class="py-2">
											@if($userAccount->edit_bank == "Y")
												<div class="">
													<h3 class="">Account Ownership</h3>
												</div>	
												<div class="">
													@php $allUserAccounts = \App\UserAccount::where('bank_account_id', $bankAccount->id)->get(); @endphp
													@foreach($allUserAccounts as $allUserAccount)
														<div class="">
															<span>{{ $allUserAccount->user->firstname }}:</span>
															<span>{{ ($allUserAccount->share_pct * 100) . "%" }}</span>
														</div>
													@endforeach
												</div>
											@endif
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center justify-content-around flex-column">
									@if($userAccount->edit_bank == "Y")
										<a class="btn btn-block btn-lg text-truncate blue" href="/account/create/{{ $bankAccount->id }}">Add Bank User</a>
										<a class="btn btn-block btn-lg text-truncate blue" href="/bank/{{ $bankAccount->id }}/users">Edit Bank Users</a>
										<a class="btn btn-block btn-lg text-truncate blue" href="/bank/{!! $bankAccount->id !!}/edit">Edit Bank</a>
										<a class="btn btn-block btn-lg btn-danger text-truncate removeBank" href="#{{ $bankAccount->id }}">Remove Bank</a>
									@endif
								</div>
							</div>
						</div>
					@else
						<div class="indBankAccount">
							<div class="bankAccountHeader">
								<h2 class="">{{ $bankAccount->bank_name }}</h2>
							</div>
							<div class="bankAccountInfo">
								<div class="">
									<p class="">You have not been granted permissions to view this banks information</p>
								</div>
							</div>	
						</div>
					@endif
				</div>
			@endforeach
		@else
			<div class="emptyAccountHeader">
				<h2 class="">You do not currently have any accounts added.</h2>
			</div>
		@endif
	</div>
</div>
@endsection