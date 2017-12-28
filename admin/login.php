<?php require_once("../include/initialize.php"); ?>
<?php if($session->is_logged_in()) { redirect_to("index.php"); } ?>
<?php 
	if(isset($_POST["submit"])) {
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		
		$foundUser = User::authenticate($username, $password);
		if(!empty($foundUser) && $foundUser->is_removed() == "N") {
			if($foundUser) {
				$session->login($foundUser);
				$foundUser->set_last_login();
				$foundUser->id = $foundUser->user_id;
				if($foundUser->save()) {
					redirect_to("index.php");
				}
			} else {
				//Username and Password combination was not found in database
				$message = ["Error" => "Username and Password combination was not found"];
				echo form_errors($message);
			}
		} else {
			// User profile has been deleted
			echo "Incorrect username / password combination.";
		}
	} else {
		// $message = ["Error" => "Form has not been submitted correctly. Please try again"];
		// $username = "";
		// $password = "";
		// echo form_errors($message);
	}
?>
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
<link rel="stylesheet" type="text/css" href="css/atstmpllc.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="scripts/atstmpllc.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--[if lte IE 9]> <script>window.open("oldBrowser/index.php", "_self");</script> <![endif]-->
<body id="admin_page_login">
	<div class="container-fluid">
		<div class="adminLoginHeader">
			<h2 class="">Administrator Login</h2>
		</div>
		<div class="">
			<form id="admin_form" method="POST" action="login.php">
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" class="form-control" name="username" placeholder="Username" />
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" name="password" placeholder="Password" />
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-2"></div>
					<div class="col-md-4 col-sm-8 form-group">
						<input type="submit" name="submit" value="Log In" id="admin_login_btn" class="form-control" />
					</div>
					<div class="col-md-4 col-sm-2"></div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>