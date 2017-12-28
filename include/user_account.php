<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');

class User_Account extends DatabaseObject {
	
	protected static $table_name = "user_account";
	protected static $db_fields=array('user_account_id', 'user_id', 'bank_name', 'bank_account_id',
		'company_id', 'checking_share', 'savings_share', 'user', 'share_pct', 'show_bank', 'edit_bank');

	public $id;
	public $user_account_id;
	public $user;
	public $user_id;
	public $bank_account_id;
	public $bank_name;
	public $checking_share;
	public $savings_share;
	public $total;
	protected $show_bank;
	protected $edit_bank;
	protected $share_pct;
	protected $company_id;
	
	function __construct() {
		
	}
	
	public function get_users_editable_banks() {
		$userBanks = self::find_by_sql("SELECT * FROM user_account WHERE user_id = '".$this->user_id."';");
		$returnArray = [];
		if(!empty($userBanks)) {
			foreach($userBanks as $userBank) {
				if($userBank->edit_bank() == "Y") { 
					array_push($returnArray, $userBank->bank_account_id);
				}
			}
		}
		return $returnArray;
	}
	
	public function get_checking_share() {
		return $this->checking_share;
	}
	
	public function get_savings_share() {
		return $this->savings_share;
	}
	
	public function get_percent_share() {
		return $this->share_pct;
	}
	
	public function show_bank() {
		return $this->show_bank;
	}
	
	public function edit_bank() {
		return $this->edit_bank;
	}
	
	public function make_deposit($amount="") {
		$this->checking_share = $this->checking_share + $amount;
		$this->save();
	}
	
	public function make_withdrawl($amount="") {
		$this->checking_balance = $this->checking_balance - $amount;
		$this->save();
	}
	
	public function make_purchase($amount="") {
		$this->checking_share = $this->checking_share - $amount;
		$this->save();
	}
	
	public function set_show_bank($show="") {
		$this->show_bank = $show;
	}

	public function set_edit_bank($editable="") {
		$this->edit_bank = $editable;
	}
	
	public function set_checking_share($amount=0) {
		return $this->checking_share = $amount;
	}
	
	public function set_savings_share($amount=0) {
		return $this->savings_share = $amount;
	}

	public function set_share_pct($shareSpl=0) {
		$shareSpl = $shareSpl / 100;
		$this->share_pct = $shareSpl;
	}

	public function set_company_id($user_id=null) {
		return $this->company_id = $user_id;
	}
	
	public function delete() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
		$this->remove_bank_share($this->bank_account_id, $this->user_account_id);
		$this->id = $this->user_account_id;
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
	
	public function recreate_shares($bankID=0, $newShare=0) {
		$bankAccount = Bank_Account::find_by_id($bankID);
		$personalTransaction = Bank_Account::find_bank_deposit_withdrawl_diff($bankAccount->bank_account_id);
		$allUsers = self::find_all_bank_users($bankAccount->bank_account_id);
		$usersCount = count($allUsers);
		$bankAccount->set_checking_balance($bankAccount->get_checking_balance() - $personalTransaction['checkingDiff']);
		$bankAccount->set_savings_balance($bankAccount->get_savings_balance() - $personalTransaction['savingDiff']);
		
		if(count($allUsers) > 1) {
			$sharePctToRemove = $newShare / $usersCount;
			foreach($allUsers as $indUser) {
				$personalTransaction = self::find_user_deposit_withdrawl_diff($indUser->user_id);
				$newUsersPct = ($indUser->get_percent_share() - $sharePctToRemove) * 100;
				$indUser->set_share_pct($newUsersPct);
				$indUser->set_checking_share(($bankAccount->get_checking_balance() * $indUser->get_percent_share()) + $personalTransaction["checkingDiff"]);
				$indUser->set_savings_share(($bankAccount->get_savings_balance() * $indUser->get_percent_share()) + $personalTransaction["savingDiff"]);
				$indUser->id = $indUser->user_account_id;
				$indUser->save();
			}
		} else {
			$personalTransaction = self::find_user_deposit_withdrawl_diff($allUsers[0]->user_id);
			$allUsers[0]->set_share_pct(($allUsers[0]->get_percent_share() - $newShare) * 100);
			$allUsers[0]->set_checking_share(($bankAccount->get_checking_balance() * $allUsers[0]->get_percent_share()) + $personalTransaction["checkingDiff"]);
			$allUsers[0]->set_savings_share(($bankAccount->get_savings_balance() * $allUsers[0]->get_percent_share()) + $personalTransaction["savingDiff"]);
			$allUsers[0]->id = $allUsers[0]->user_account_id;
			$allUsers[0]->save();
		}
		
	}
	
	private function remove_bank_share($bankID=0, $userAccID=0) {
		$bank_users = User_Account::find_by_sql("SELECT * FROM user_account WHERE bank_account_id = '".$bankID."' AND user_account_id <> '".$userAccID."';");
		$remainingUsers = count($bank_users);
		$checkingBalSplit = $this->get_checking_share() / $remainingUsers;
		$savingsBalSplit = $this->get_savings_share() / $remainingUsers;
		$shareBalSplit = ($this->get_percent_share() / $remainingUsers) * 100;
		foreach($bank_users as $bank_user) {
			$bank_user->id = $bank_user->user_account_id;
			$bank_user->set_checking_share($bank_user->get_checking_share() + $checkingBalSplit);
			$bank_user->set_savings_share($bank_user->get_savings_share() + $savingsBalSplit);
			$bank_user->set_share_pct(($bank_user->get_percent_share() * 100) + $shareBalSplit);
			if($bank_user->save()) {
				echo "It got here";
			}
		}
	}
	
	public static function find_all_bank_users($bankAccountID) {
		$result_array = self::find_by_sql("SELECT * FROM user_account WHERE bank_account_id = '".$bankAccountID."';");

		if(!empty($result_array)) {
			if(count($result_array) > 0) {
				$return_results_array = array();
				for($i=0; $i < count($result_array); $i++) {
					array_push($return_results_array, $result_array[$i]);
				}
				return $return_results_array;
			} else {
				array_shift($result_array);
			}
		} else {
			return false;
		}
	}
		
	public static function find_all_users_shares($bankAccountID) {
		$bankUsers = self::find_by_sql("SELECT * FROM user_account WHERE bank_account_id='".$bankAccountID."';");
		$newShare = $addtShare;
		$totalShare = 0;
		foreach($bankUsers as $bankUser) {
			$totalShare = $totalShare + ($bankUser->get_percent_share() * 100);
		}
		
		return $totalShare;
	}
	
	public static function find_user_deposit_withdrawl_diff($userID, $bankAccountID) {
		$userTrans = Transaction::find_by_sql("SELECT * FROM `transaction` WHERE (`bank_account_id` = '".$bankAccountID."') AND (`deposit_type` = 'personal' OR `withdrawl_type` = 'personal' OR `type` = 'Transfer')");
		$totalCheckingDiff = 0;
		$totalSavingsDiff = 0;
		foreach($userTrans as $indTrans) {
			if($userID == $indTrans->user_id) {
				if($indTrans->account_type == "checking") {
					if($indTrans->type == "Deposit") {
						$totalCheckingDiff += $indTrans->amount;
					} elseif($indTrans->type == "Withdrawl") {
						$totalCheckingDiff -= $indTrans->amount;
					}  elseif($indTrans->type == "Transfer") {
						if($indTrans->transfer_type == "account" && $indTrans->transfer_to == "savings") {
							$totalCheckingDiff -= $indTrans->amount;
							$totalSavingsDiff += $indTrans->amount;
						} elseif($indTrans->transfer_type == "user") {
							$totalCheckingDiff -= $indTrans->amount;
						} 
					}
				} elseif($indTrans->account_type == "savings") {
					if($indTrans->type == "Deposit") {
						$totalSavingsDiff += $indTrans->amount;
					} elseif($indTrans->type == "Withdrawl") {
						$totalSavingsDiff -= $indTrans->amount;
					}  elseif($indTrans->type == "Transfer") {
						if($indTrans->transfer_type == "account" && $indTrans->transfer_to == "checking") {
							$totalCheckingDiff += $indTrans->amount;
							$totalSavingsDiff -= $indTrans->amount;
						} elseif($indTrans->transfer_type == "user") {
							$totalSavingsDiff -= $indTrans->amount;
						}
					}
				}
			} elseif($userID == $indTrans->transfer_to) {
				$totalCheckingDiff += $indTrans->amount;
			}
		}
		return ["savingDiff" => $totalSavingsDiff, "checkingDiff" => $totalCheckingDiff];
	}
}

?>