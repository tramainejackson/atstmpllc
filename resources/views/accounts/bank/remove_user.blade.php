<div class="modal fade removeUserAccountModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="">Confirm User Removal</h5>
			</div>
			<div class="text-danger progress-bar-striped bg-warning px-4 py-2">
				<div class="">
					<p class="text-center">*Removing this user will delete their transactions. You will have to reallocate their ownership percentage</p>
					<h1 class="text-center">{{ $userAccount->bank_account->bank_name}}</h1>
					<h4 class="text-center">{{ $userAccount->user->firstname . ' ' . $userAccount->user->lastname }}</h4>
				</div>
				<div class="">
					<div class="">
						<div class="">
							<span class="spanLabel">Checking Share:</span>
							<span class="itemContent">{{ "$" . number_format($userAccount->checking_share, 2) }}</span>
						</div>
					</div>
					<div class="">
						<div class="">
							<span class="spanLabel">Savings Share:</span>
							<span class="itemContent">{{ "$" . number_format($userAccount->savings_share, 2) }}</span>
						</div>
					</div>
					<div class="">
						<div class="">
							<span class="spanLabel">Account Ownership:</span>
							<span class="">{{ $userAccount->share_pct * 100 . '%' }}</span>
						</div>
					</div>
					<div class="">
						{!! Form::open(['action' => ['UserAccountController@destroy', $userAccount->id], 'method' => 'DELETE']) !!}
							<div class="form-group">
								{{ Form::submit('Remove User', ['class' => 'btn btn-lg btn-danger my-3']) }}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>