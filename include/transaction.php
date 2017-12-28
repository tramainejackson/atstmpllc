<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');

class Transaction extends DatabaseObject {
	
	protected static $table_name = "transaction";
	protected static $db_fields=array('transaction_id', 'bank_account_id', 'type', 'deposit_type', 'withdrawl_type', 'transfer_type', 'transfer_to', 'account_type', 'amount', 'date', 'receipt', 'receipt_photo', 'user_id', 'user', 'company_id');
	
	public $id;
	public $transaction_id;
	public $type;
	public $withdrawl_type;
	public $deposit_type;
	public $transfer_type;
	public $transfer_to;
	public $account_type;
	public $amount;
	public $date;
	public $receipt;
	public $receipt_photo;
	public $user_id;
	public $user;
	public $company_id;
	public $bank_account_id;
	
	function __construct() {
		
	}
	
	public static function find_all_trans() {
		$result_array = self::find_by_sql("SELECT * FROM transactions;");
		
		if(!empty($result_array)) {
			if(count($result_array) > 0) {
				$return_results_array = array();
				for($i=0; $i < count($result_array); $i++) {
					array_push($return_results_array, $result_array[$i]);
				}
				return $return_results_array;
			} else {
				return array_shift($result_array);
			}
		} else {
			return false;
		}
	}
	
	public static function find_by_id($id=0) {
		$result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE user_id='".$id."';");
		if(!empty($result_array)) {
			if(count($result_array) > 0) {
				$return_results_array = array();
				for($i=0; $i < count($result_array); $i++) {
					array_push($return_results_array, $result_array[$i]);
				}
				return $return_results_array;
			} else {
				return array_shift($result_array);
			}
		} else {
			return false;
		}
	}
}

?>