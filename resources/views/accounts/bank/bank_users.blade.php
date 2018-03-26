@if($bank_accounts->count() > 1)
	@foreach($bank_accounts as $bank_account)
		<option class="userOption" value="{{ $bank_account->id }}" {{ $bank_account->user_id == Auth::id() ? 'disabled' : '' }}>{{ $bank_account->user->firstname }}{{ $bank_account->user_id == Auth::id() ? ' - logged in user' : '' }}</option>
	@endforeach
@else
	<option class="userOption">No other users have an account for this bank</option>
@endif