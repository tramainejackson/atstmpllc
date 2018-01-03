@if($bank_accounts->count() > 1)
	@foreach($bank_accounts as $bank_account)
		<option class="userOption">{{ $bank_account->user->firstname }}</option>
	@endforeach
@else
	<option class="userOption">No other users have an account for this bank</option>
@endif