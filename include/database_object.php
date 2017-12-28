<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');
require_once('sessions.php');

class DatabaseObject {
	
	// Common Database Methods
	public static function find_all($company_id=0) {
		return static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE company_id = '".$company_id."' ORDER BY ".static::$table_name."_id DESC;");
	}
	
	public static function find_by_id($id=0) {
		$result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE ".static::$table_name."_id='".$id."' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
		  $object_array[] = static::instantiate($row);
		}
		// echo"<pre>";
		// print_r($object_array);
		// echo"</pre>";
		return $object_array;
	}
	
	public static function checkNewPicture($filesArray) {
		// $addID = find_player_by_username($_SESSION["user"]);
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($filesArray["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if($filesArray["name"] != "") {
			$check = getimagesize($filesArray["tmp_name"]);
			if($check !== false) {
				$_SESSION["message"] .= "<li class='okItem'>File is an image - " . $check["mime"] . ".</li>";
				$uploadOk = 1;
			} else {
				$_SESSION["errors"] .= "<li class='errorItem'>File is not an image.</li>";
				$uploadOk = 0;
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				$_SESSION["errors"] .= "<li class='errorItem'>Sorry, picture already exists.</li>";
				$uploadOk = 0;
			}
			// Check file size
			if ($filesArray["size"] > 2000000) {
				$_SESSION["errors"] .= "<li class='errorItem'>Sorry, your file is too large.</li>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$_SESSION["errors"] .= "<li class='errorItem'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</li>";
				$uploadOk = 0;
			}
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$_SESSION["errors"] .= "<li class='errorItem'>Sorry, your picture was not uploaded.</li>";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($filesArray["tmp_name"], $target_file)) {
				return [true, $target_file];
			} else {
				return false;
			}
		}
	}

	private static function instantiate($record) {
		// Could check that $record exists and is an array
		$object = new static;
		// Simple, long-form approach:
		// $object->id 			= $record['user_id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name  = $record['firstname'];
		// $object->last_name 	= $record['lastname'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
			$object->$attribute = $value;
		  }
		}
		return $object;
	}

	private function has_attribute($attribute) {
	  // get_object_vars returns an associative array with all attributes 
	  // (incl. private ones!) as the keys and their current values as the value
	  $object_vars = get_object_vars($this);
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $object_vars);
	}

	protected function attributes() { 
		// return an array of attribute names and their values
		$attributes = array();
		foreach(static::$db_fields as $field) {
			if(property_exists($this, $field)) {
				if($this->$field == "" || $this->$field == null) {				
					//Skip adding db field is value is empty
				} else {
					$attributes[$field] = $this->$field;
				}
			}
		}
		return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".static::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";

		if($database->query($sql)) {
			$this->id = $database->insert_id();
			return true;
		} else {
			return false;
		}
	}

	public function update() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
			if($value == "" || $value == null) {
				// Skip adding empty fields to update SQL query
			} else {
				$attribute_pairs[] = "{$key}='{$value}'";
			}
		}

		$sql = "UPDATE ".static::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE ". static::$table_name ."_id='". $database->escape_value($this->id) . "';";
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}

	public function delete() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
		$tableID = static::$table_name . "_id";
		$sql = "DELETE FROM ".static::$table_name;
		$sql .= " WHERE ".static::$table_name."_id=". $database->escape_value($this->id);
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