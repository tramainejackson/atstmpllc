<div class="modal fade removeBankModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="">Confirm Delete Bank</h5>
			</div>
			<div class="text-danger progress-bar-striped bg-warning px-4 py-2">
				<div class="">
					<p class="text-center">*Deleting this bank will remove all of its transactions and user accounts permantly</p>
					<h1 class="text-center">{{ $bankAccount->bank_name}}</h1>
				</div>
				<div class="">
					<div class="">
						<div class="">
							<h3 class="">Checking: </h3>
						</div>
						<div class="">
							<span class="spanLabel">Balance:</span>
							<span class="itemContent">{{ "$" . number_format($bankAccount->checking_balance, 2) }}</span>
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
					</div>
					<div class="">
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
					</div>
					<div class="">
						{!! Form::open(['action' => ['BankAccountController@destroy', $bankAccount->id], 'method' => 'DELETE']) !!}
							<div class="form-group">
								{{ Form::submit('Delete Bank', ['class' => 'btn btn-lg btn-danger my-3']) }}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>