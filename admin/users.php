<?php require_once("../include/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<!DOCTYPE html>
<html lang="en">
<title>ATSTMPLLC Admin</title>
<meta charset="utf-8">
<meta />
<meta />
<meta />
<meta />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="scripts/mp/dist/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="css/atstmpllc.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="scripts/mp/dist/jquery.magnific-popup.min.js"></script>
<script src="scripts/atstmpllc.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--[if lte IE 9]> <script>window.open("oldBrowser/index.php", "_self");</script> <![endif]-->
<body id="">
<div class="container-fluid">
	<?php include_once("nav.php"); ?>
	<?php $session->showSessionMessages(); ?>
	<?php $current_user = User::find_by_id($session->user_id); ?>
	<?php if(isset($_GET["remove_user"])) { ?>
		<?php if(isset($_GET["id"])) { ?>
			<?php $remove_user = User::find_by_id($_GET["id"]); ?>
			<?php if(!empty($remove_user)) { ?>
				<?php if(($remove_user->is_editable() == "Y" && $remove_user->is_removed() == "N")) { ?>
					<div class="userNavLinks">
						<a href="users.php?add_user" class="">Add New User</a>
						<a href="users.php?remove_user" class="">Remove A User</a>
						<a href="users.php?edit_user" class="">Edit A User</a>
					</div>
					<div class="removeUserNotification row">
						<h3 class="removeUserNotificationHeader">All user accounts will be deleted and user remaining balances will distributed evenly among remaining users.</h3>
					</div>
					<?php $remove_user_accounts = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id = '".$remove_user->user_id."';"); ?>
					<div class="removeUserForm row">
						<div class="formDiv">
							<form name="" class="" action="remove_user.php" method="POST" enctype="multipart/form-data">
								<div class="row">
									<h2 class="">Remove User</h2>
								</div>
								<div class="removeIndUser row">
									<div class="userImgDiv col-md-3 col-sm-4">
										<?php if($remove_user->picture != null) { ?>
											<img src="<?php echo $remove_user->picture ?>" class="center-block" />
										<?php } else { ?>
											<img src="../images/emptyface.jpg" class="center-block" />
										<?php } ?>
									</div>
									<div class="col-md-9 col-sm-8">
										<div class="row">
											<span class="col-md-4 col-sm-5">Username</span>
											<input disabled type="text" name="" class="col-md-8 col-sm-7" value="<?php echo $remove_user->username; ?>" />
										</div>
										<div class="row">
											<span class="col-md-4 col-sm-5">Full Name</span>
											<input disabled type="text" name="" class="col-md-8 col-sm-7" value="<?php echo $remove_user->full_name(); ?>" />
										</div>
										<?php if(!empty($remove_user_accounts)) { ?>
											<?php foreach($remove_user_accounts as $remove_user_account) { ?>
													<div class="row">
														<span class="col-md-4 col-sm-5">Bank Name</span>
														<input disabled type="text" name="" class="col-md-8 col-sm-7" value="<?php echo $remove_user_account->bank_name; ?>" />
													</div>
													<div class="row">
														<span class="col-md-4 col-sm-5">Checking Share</span>
														<input disabled type="text" name="" class="col-md-8 col-sm-7" value="<?php echo $remove_user_account->get_checking_share(); ?>" />
													</div>
													<div class="row">
														<span class="col-md-4 col-sm-5">Savings Share</span>
														<input disabled type="text" name="" class="col-md-8 col-sm-7" value="<?php echo $remove_user_account->get_savings_share(); ?>" />
													</div>
													<div class="row">
														<span class="col-md-4 col-sm-5">Bank Share Percentage</span>
														<input disabled type="text" name="" class="col-md-8 col-sm-7" value="<?php echo ($remove_user_account->get_percent_share() * 100) . "%"; ?>" />
													</div>
													<div class="row">
														<span class="col-md-4 col-sm-5">Last Login</span>
														<input disabled type="text" name="" class="col-md-8 col-sm-7" value="<?php if($remove_user->last_login == null) { echo "This user has 0 logins."; } else { echo $remove_user->last_login; } ?>" />
													</div>
											<?php } ?>
										<?php } else { ?>
											<div class="row">
												<span class="col-md-4 col-sm-5">Last Login</span>
												<input disabled type="text" name="" class="col-md-8 col-sm-7" value="<?php if($remove_user->last_login == null) { echo "This user has 0 logins."; } else { echo $remove_user->last_login; } ?>" />
											</div>
											<div class="row">
												<span class="noAccountsRemoveDiv col-md-12 col-sm-12">User doesn't have any banks accounts added to remove</span>
											</div>
										<?php } ?>
										<div hidden class="">
											<input type="number" name="user_id" class="" value="<?php echo $remove_user->user_id; ?>" />
										</div>
									</div>
									<div class="clearfix col-md-12 col-sm-12 col-xs-12">
										<input type="submit" name="submit" class="col-md-12" value="Remove" />
									</div>
								</div>
							</form>
						</div>
					</div>
				<?php } else { ?>
					<?php if($remove_user->user_id == $current_user->user_id) { ?>
						<div class="">
							<span>You cannot remove your own account</span>
						</div>
					<?php } else { ?>
						<div class="">
							<span>There is not user account listed to be removed</span>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } else { ?>
				<div class="">
					<span>There is not user account listed to be removed</span>
				</div>
			<?php } ?>
		<?php } else { ?>
			<?php $users = User::find_all($current_user->get_company_id()); ?>
			<div class="removeUsers">
				<div class="userNavLinks">
					<a href="users.php?add_user" class="">Add New User</a>
					<a href="users.php?edit_user" class="">Edit A User</a>
				</div>
				<div class="row">
					<div class="allUsers row">
						<?php foreach($users as $user) { ?>
							<?php if($user->is_editable() == "Y" && $user->is_removed() == "N") { ?>
								<div class="userCard col-md-3 col-sm-4 col-xs-6">
									<div class="">
										<?php if($user->picture != null) { ?>
											<img src="<?php echo $user->picture ?>" class="" />
										<?php } else { ?>
											<img src="../images/emptyface.jpg" class="" />
										<?php } ?>
									</div>
									<div class="userCardPlate">
										<a href='users.php?remove_user&id=<?php echo $user->user_id; ?>'>Remove - <?php echo $user->full_name(); ?></a>
									</div>
								</div>
							<?php } elseif($user->is_editable() == "N" && $user->is_removed() == "N") { ?>
								<div class="userCard col-md-3 col-sm-4 col-xs-6">
									<div class="">
										<img src="../images/<?php echo $user->picture ?>" class="" />
									</div>
									<div class="userCardPlate">
										<a href='#'><?php echo $user->full_name(); ?></a>
									</div>
								</div>
							<?php } ?>
						<?php } ?>	
					</div>
				</div>
			</div>
		<?php } ?>
	<?php } elseif(isset($_GET["add_user"])) { ?>
		<div class="userNavLinks">
			<a href="users.php?remove_user" class="">Remove A User</a>
			<a href="users.php?edit_user" class="">Edit A User</a>
		</div>
		<div class="row">
			<div class="formDiv">
				<form name="new_user" class="" action="add_user.php" method="POST" enctype="multipart/form-data" onsubmit="userErrorCheck();">
					<div class="formDivTitle row">
						<h2 class="">Create New User</h2>
					</div>
					<div class="row">
						<span class="col-md-3">Username</span>
						<input type="text" name="username" class="newUsername col-md-6" />
					</div>
					<div class="row">
						<span class="col-md-3">Password</span>
						<input type="text" name="password" class="newPassword col-md-6" />
					</div>
					<div class="row">
						<span class="col-md-3">Firstname</span>
						<input type="text" name="firstname" class="newFirstname col-md-6" />
					</div>
					<div class="row">
						<span class="col-md-3">Lastname</span>
						<input type="text" name="lastname" class="newLastname col-md-6" />
					</div>
					<div class="row">
						<span class="col-md-3">Editable</span>
						<select class="col-md-6" name="editable">
							<option value="Y" selected>Yes</option>
							<option value="N">No</option>
						</select>
					</div>
					<div class="row">
						<span class="col-md-3">Picture</span>
						<input type="file" name="picture" class="col-md-6" />
					</div>
					<div class="row">
						<input type="submit" name="submit" class="" value="Create" />
					</div>
				</form>
			</div>
		</div>
	<?php } elseif(isset($_GET["edit_user"])) { ?>
		<div class="userNavLinks">
			<a href="users.php?add_user" class="">Add New User</a>
			<a href="users.php?remove_user" class="">Remove A User</a>
			<a href="users.php?edit_user" class="">Edit A User</a>
		</div>
		<?php if(isset($_GET["id"])) { ?>
			<?php $edit_user = User::find_by_id($_GET["id"]); ?>
			<?php if($edit_user->is_editable() == "Y") { ?>
				<div class="row">
					<div class="formDiv">
						<form name="edit_user" class="" action="edit_user.php" method="POST" enctype="multipart/form-data">
							<div class="formDivTitle row">
								<h2 class="">Edit User</h2>
							</div>
							<div class="row">
								<div class="userImgDiv col-md-3 col-sm-4">
									<?php if($edit_user->picture != null) { ?>
										<img src="<?php echo $edit_user->picture ?>" class="center-block" />
									<?php } else { ?>
										<img src="../images/emptyface.jpg" class="center-block" />
									<?php } ?>
								</div>
								<div class="col-md-9 col-sm-8">
									<div class="row">
										<input hidden type="number" name="id" class="" value="<?php echo $edit_user->user_id; ?>" />
									</div>
									<div class="row">
										<span class="col-md-4 col-sm-5">Username</span>
										<input type="text" name="username" class="col-md-8 col-sm-7" value="<?php echo $edit_user->username; ?>" disabled />
									</div>
									<div class="row">
										<span class="col-md-4 col-sm-5">Password</span>
										<input type="text" name="password" class="col-md-8 col-sm-7" value="" placeholder="Enter New Password" />
									</div>
									<div class="row">
										<span class="col-md-4 col-sm-5">Firstname</span>
										<input type="text" name="firstname" class="col-md-8 col-sm-7" value="<?php echo $edit_user->firstname; ?>" placeholder="Enter New Firstname" />
									</div>
									<div class="row">
										<span class="col-md-4 col-sm-5">Lastname</span>
										<input type="text" name="lastname" class="col-md-8 col-sm-7" value="<?php echo $edit_user->lastname; ?>" placeholder="Enter New Lastname" />
									</div>
									<div class="row">
										<span class="col-md-4 col-sm-5">Editable</span>
										<select class="col-md-8 col-sm-7" name="editable">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>
									<div class="row">
										<span class="col-md-4 col-sm-5">Picture</span>
										<input type="file" name="picture" class="col-md-8 col-sm-7" value="" placeholder="" />
									</div>
								</div>
								<div class="clearfix col-md-12 col-sm-12">
									<input type="submit" name="submit" class="" value="Update" />
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php } else { ?>
				<?php echo "This users account is uneditable."; ?>
			<?php } ?>
		<?php } else { ?>
			<div class="row">
				<div class="allUsers row">
					<?php $users = User::find_all($current_user->get_company_id()); ?>
					<?php foreach($users as $user) { ?>
						<?php if($user->is_editable() == "Y" && $user->is_removed() == "N") { ?>
							<div class="userCard col-md-3 col-sm-4 col-xs-6">
								<div class="">
									<?php if($user->picture != null) { ?>
										<img src="<?php echo $user->picture ?>" class="" />
									<?php } else { ?>
										<img src="../images/emptyface.jpg" class="" />
									<?php } ?>
								</div>
								<div class="userCardPlate">
									<a href="users.php?edit_user&id=<?php echo $user->user_id; ?>">Edit - <?php echo $user->full_name(); ?></a>
								</div>
							</div>
						<?php } elseif($user->is_editable() == "N" && $user->is_removed() == "N") { ?>
							<div class="userCard col-md-3 col-sm-4 col-xs-6">
								<div class="">
									<?php if($user->picture != null) { ?>
										<img src="<?php echo $user->picture ?>" class="" />
									<?php } else { ?>
										<img src="../images/emptyface.jpg" class="" />
									<?php } ?>
								</div>
								<div class="userCardPlate">
									<a href='#'><?php echo $user->full_name(); ?></a>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	<?php } else { ?>
		<div class="userNavLinks">
			<a href="users.php?add_user" class="">Add New User</a>
			<a href="users.php?remove_user" class="">Remove A User</a>
			<a href="users.php?edit_user" class="">Edit A User</a>
		</div>
	<?php } ?>
	<?php include_once("footer.php"); ?>
</div>
</body>
</html>