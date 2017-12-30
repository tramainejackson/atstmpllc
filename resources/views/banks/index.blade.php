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
		<div class="col-12">	
			@if(!empty($userAccounts))
				@if($userAccounts->count() > 0)
					<div class="row">
						@foreach($userAccounts as $userAccount)
							@php $bankAccount = \App\BankAccount::find($userAccount->bank_account_id); @endphp
							@if($userAccount->edit_bank == "Y")
								<div class="indBankAccount addBoxShadow center-block">
									<div class="bankAccountHeader">
										<h2 class="">{{ $bankAccount->bank_name}}</h2>
									</div>
									<div class="bankAccountInfo">
										<div class="">
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
										<div class="">
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
										<div class="">
											@if($userAccount->edit_bank == "Y")
												<div class="">
													<h3 class="">Share Split</h3>
												</div>	
												<div class="">
													@php $allUserAccounts = \App\UserAccount::where('bank_account_id', $bankAccount->id)->get(); @endphp
													@foreach($allUserAccounts as $allUserAccount)
														<span>{{ $allUserAccount->user->firstname }}:</span>
														<span>{{ ($allUserAccount->share_pct * 100) . "%" }}</span>
													@endforeach
												</div>
											@endif
										</div>
									</div>
									<div class="indBankAccountLinks container-fluid">
										<div class="row align-items-center justify-content-around">
											@if($userAccount->edit_bank == "Y")
												<a class="btn col-2 editBankLink" href="/bank/{!! $bankAccount->id !!}/edit" class="">Edit Bank Account</a>
												<a class="btn col-2 editBankLink" href="bank.php?edit_share={{ $bankAccount->id }}" class="">Edit Users Shares</a>
												<a class="btn col-2 editBankLink" href="bank.php?create_share={{ $bankAccount->id }}" class="">Create New Share</a>
												<a class="btn btn-danger col-2 editBankLink" href="bank.php?create_share={{ $bankAccount->id }}" class="">Remove Bank</a>
												</div>
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
						@endforeach
					</div>
				@else
					<div class="emptyAccountHeader">
						<h2 class="">You do not currently have any accounts added.</h2>
					</div>
				@endif
			@endif
		</div>
	</div>
</div>
@endsection