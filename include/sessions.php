<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions

class Session {
	
	private $logged_in=false;
	public $user_id;
	public $last_log_in;
	public $message;
	
	function __construct() {
		session_start();
		$this->check_message();
		$this->check_errors();
		$this->check_login();
		if($this->logged_in) {
			// actions to take right away if user is logged in
		} else {
			// actions to take right away if user is not logged in
		}
	}
	
	public function is_logged_in() {
		return $this->logged_in;
	}

	public function login($user) {
		// database should find user based on username/password
		if($user){
		  $this->user_id = $_SESSION['user_id'] = $user->user_id;
		  $this->last_log_in = $_SESSION['last_log_in'] = $user->last_login;
		  $this->logged_in = true;
		}
	}
  
	public function logout() {
		unset($_SESSION['user_id']);
		unset($_SESSION['last_log_in']);
		unset($this->user_id);
		$this->logged_in = false;
	}
	
	public function message($msg="") {
		if(!empty($msg)) {
			// this is "set message"
			if(isset($_SESSION['message'])) {
				$_SESSION['message'] .= $msg;
			} else {
				$_SESSION['message'] = $msg;
			}
		} else {
			// this is "get message"
			return $this->message;
		}
	}

	private function check_login() {
		if(isset($_SESSION['user_id'])) {
		  $this->user_id = $_SESSION['user_id'];
		  $this->last_log_in = $_SESSION['last_log_in'];
		  $this->logged_in = true;
		} else {
		  unset($this->user_id);
		  $this->logged_in = false;
		}
	}
	
	private function check_message() {
		// Is there a message stored in the session?
		if(isset($_SESSION['message'])) {
			// Add it as an attribute and erase the stored version
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else {
			$this->message = "";
		}
	}
	
	private function check_errors() {
		// Is there a error stored in the session?
		if(isset($_SESSION['error'])) {
			// Add it as an attribute and erase the stored version
			$this->error = $_SESSION['error'];
			unset($_SESSION['error']);
		} else {
			$this->error = "";
		}
	}
	
	public function showSessionMessages() { 
		echo "<div id='return_messages'><ul>";
			if(!empty($this->message)) { echo $this->message; } 
		echo "</ul></div>";
	}
  
}

$session = new Session();
$message = $session->message();

?>