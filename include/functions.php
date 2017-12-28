<?php
	$date = date("Y-m-d H:i:s");
	date_default_timezone_set("America/New_York");
	
	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}
	
	function datetime_to_text($datetime="") {
	  $unixdatetime = strtotime($datetime);
	  return strftime("%B %d, %Y", $unixdatetime);
	}
	
	function datetime_to_slash($datetime="") {
	  $unixdatetime = strtotime($datetime);
	  return strftime("%m/%d/%Y", $unixdatetime);
	}
	
	function find_all_admins() {
		global $connect;
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "ORDER BY username ASC";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		return $admin_set;
	}

	function find_admin_by_id($admin_id) {
		global $connect;
		
		$safe_admin_id = mysqli_real_escape_string($connect, $admin_id);
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE id = {$safe_admin_id} ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}

	function find_admin_by_username($username) {
		global $connect;
		
		$safe_username = mysqli_real_escape_string($connect, $username);
		
		$query  = "SELECT * ";
		$query .= "FROM users ";
		$query .= "WHERE username = '".$safe_username."' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}
	
	function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
		$hash = password_verify($password, $existing_hash);
		if ($hash === true) {
			return true;
		} else {
			return false;
		}
	}

	function attempt_login($username, $password) {
		$admin = find_admin_by_username($username);
		if ($admin) {
			// found admin, now check password
			if (password_check($password, $admin["password"])) {
				// password matches
				return $admin;
			} else {
				// password does not match
				return false;
			}
		} else {
			// admin not found
			return false;
		}
	}
	
	function checkNewPicture($filesArray) {
		// $addID = find_player_by_username($_SESSION["user"]);
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($filesArray["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if($filesArray["name"] != "") {
			$check = getimagesize($filesArray["tmp_name"]);
			if($check !== false) {
				// $_SESSION["message"] .= "<li class='okItem'>File is an image - " . $check["mime"] . ".</li>";
				$uploadOk = 1;
			} else {
				// $_SESSION["errors"] .= "<li class='errorItem'>File is not an image.</li>";
				$uploadOk = 0;
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				// $_SESSION["errors"] .= "<li class='errorItem'>Sorry, picture already exists.</li>";
				$uploadOk = 0;
			}
			// Check file size
			if ($filesArray["size"] > 2000000) {
				// $_SESSION["errors"] .= "<li class='errorItem'>Sorry, your file is too large.</li>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				// $_SESSION["errors"] .= "<li class='errorItem'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</li>";
				$uploadOk = 0;
			}
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			// $_SESSION["errors"] .= "<li class='errorItem'>Sorry, your picture was not uploaded.</li>";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($filesArray["tmp_name"], $target_file)) {
				return [true, $target_file];
			} else {
				return false;
			}
		}
	}
	
	function login_verification() {
		if(empty($_SESSION['user'])) {
			redirect_to("index.php");
		}
	}
	
	function cleanValues($values) {
		global $connect;
		$returnValue = null;
		
		if(is_array($values)) {
			$returnValue = array();
			$arrayValues = $values;
			
			for($i=0; $i < count($arrayValues); $i++) {
				$newValue = mysqli_real_escape_string($connect, trim($arrayValues[$i]));
				array_push($returnValue, $newValue);
			}
		} else {
			$returnValue = "";
			$returnValue = mysqli_real_escape_string($connect, trim($values));
		}
		
		return $returnValue;
	}
	
	function __autoload($class_name) {
		$class_name = strtolower($class_name);
		$path = "../includes/{$class_name}.php";
		if(file_exists($path)) {
		require_once($path);
		} else {
			die("The file {$class_name}.php could not be found.");
		}
	}

?>