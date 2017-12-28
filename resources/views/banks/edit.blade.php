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
			@php $editBankUsers = \App\UserAccount::where("bank_account_id", $bankAccount->id)->get(); @endphp
			<div class="editBank">
				<div class="formDiv">
					<form name="" class="" action="edit_bank.php" method="POST" enctype="multipart/form-data">
						<div class="formDivTitle">
							<h2 class="">Edit Bank Information</h2>
						</div>
						<div class="form-group">
							<label class="form-label">Bank Name</label>
							<input type="text" name="bank_name" class="form-control" value="<?php echo $bankAccount->bank_name; ?>" placeholder="Enter Bank Name" />
						</div>
						<div class="form-group">
							<label class="form-label">Account Number</label>
							<input type="text" name="account_num" class="form-control" value="<?php echo $bankAccount->account_num; ?>" placeholder="Enter Account Number" />
						</div>
						<div class="form-group">
							<label class="form-label">Checking Balance</label>
							<input type="number" name="checking_balance" class="form-control" value="<?php echo number_format($bankAccount->checking_balance, 2); ?>" placeholder=Enter Checking Balance"" />
						</div>
						<div class="form-group">
							<label class="form-label">Saving Balance</label>
							<input type="number" name="savings_balance" class="form-control" value="<?php echo number_format($bankAccount->savings_balance, 2); ?>" placeholder="Enter Savings Balance" />
						</div>
						<div class="form-group">
							<input hidden type="text" name="bank_id" value="<?php echo $bankAccount->id; ?>" />
						</div>
						<div class="bankUsers">
							@foreach($editBankUsers as $editBankUser)
								@php $bankUser = \App\User::find($editBankUser->user_id); @endphp
								<div class="editBankUser">
									<div class="row">
										<label class="form-label">User</label>
										<input type="text" name="user" class="form-control" value="<?php echo $bankUser->firstname; ?>" placeholder="" disabled />
									</div>
									<div class="row">
										<label class="form-label">Can Edit Bank</label>
										<?php if($bankUser->editable == "Y") { ?>
											<select class="custom-select form-control" name="edit_bank[]">
												<?php if($editBankUser->edit_bank == "Y") { ?>
													<option value="Y" selected>Yes</option>
													<option value="N">No</option>
												<?php } else { ?>
													<option value="Y">Yes</option>
													<option value="N" selected>No</option>
												<?php } ?>
											</select>
										<?php } else { ?>
											<select class="custom-select form-control" name="show_bank[]" disabled>
												<option value="admin">Administrator</option>
											</select>
										<?php } ?>
									</div>
									<div hidden class="">
										<?php if($bankUser->editable == "Y") { ?>
											<input type="text" name="user_account_id[]" class="form-control" value="<?php echo $editBankUser->user_account_id; ?>" placeholder="" />
										<?php } ?>
									</div>
								</div>
							@endforeach
						</div>
						<div class="form-group">
							<input type="submit" name="submit" class="form-control btn btn-outline-success" value="Update All" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection