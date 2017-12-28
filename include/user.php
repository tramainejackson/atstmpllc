<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');
require_once('sessions.php');

class User extends DatabaseObject {
	
	protected static $table_name = "user";
	protected static $db_fields=array('user_id', 'username', 'password', 'firstname', 'lastname', 'picture', 'last_login', 'company_id', 'editable', 'removed');
	
	public $id;
	public $last_login;
	public $picture;
	public $user_id;
	public $username;
	public $password;
	public $firstname;
	public $lastname;
	protected $company_id;
	protected $editable;
	protected $removed;
	
	public function full_name() {
		if(isset($this->firstname) && isset($this->lastname)) {
		  return $this->firstname . " " . $this->lastname;
		} else {
		  return "";
		}
	}
	
	public function get_company_id() {
		return $this->company_id;
	}
	
	public function set_company_id($company_id=null) {
		$this->company_id = $company_id;
	}
	
	public function set_firstname($firstname=null) {
		$this->firstname = $firstname;
	}
	
	public function set_lastname($lastname=null) {
		$this->lastname = $lastname;
	}
	
	public function set_password($password=null) {
		$this->password = $password;
	}
	
	public function set_editable($edit="") {
		$this->editable = $edit;
	}
	
	public function set_picture($picture="") {
		$this->picture = "../uploads/" . $picture;
	}
	
	public function set_last_login() {
		$this->last_login = date("Y-m-d h:i:s");
	}
	
	public function is_editable() {
		return $this->editable;
	}
	
	public function is_removed() {
		return $this->removed;
	}
	
	public function removed($remove=null) {
		return $this->removed = $remove;
	}
	
	public static function authenticate($username="", $password="") {
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value($password);
		
		$sql  = "SELECT * FROM ".static::$table_name." ";
		$sql .= "WHERE username = '".$username."' ";
		$sql .= "LIMIT 1";
		$result_array = self::find_by_sql($sql);
		if(!empty($result_array)) {
			$verify_password = password_check($password, $result_array[0]->password);
			
			if($verify_password != false) {
				// $ = self::
				// $sql  = "UPDATE ".static::$table_name." ";
				// $sql .= "SET last_login = '".date("Y-m-d h:i:s")."' ";
				// $sql .= "WHERE username = '".$username."';";
				// $database->query($sql);
				return array_shift($result_array);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function delete() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
		$tableID = static::$table_name . "_id";
		$sql = "UPDATE user ".static::$table_name;
		$sql .= " SET removed = 'Y'";
		$sql .= " WHERE user_id=". $database->escape_value($this->id);
		$sql .= " LIMIT 1";
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;

		// NB: After deleting, the instance of User still 
		// exists, even though the database entry does not.
		// This can be useful, as in:
		//   echo $user->first_name . " was deleted";
		// but, for example, we can't call $user->update() 
		// after calling $user->delete().
	}
}

?>