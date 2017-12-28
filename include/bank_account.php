<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');

class Bank_Account extends DatabaseObject {
	
	protected static $table_name = "bank_account";
	protected static $db_fields=array('bank_account_id', 'bank_name', 'account_num',
		'checking_balance', 'savings_balance', 'added_by', 'added_date', 'company_id');

	public $id;
	public $bank_account_id;
	public $bank_name;
	public $added_by;
	protected $account_num;
	protected $checking_balance;
	protected $savings_balance;
	protected $company_id;
	protected $user_account_id;
	
	// public $added_date;
	
	function __construct() {
		
	}
	
	public function get_checking_balance() {
		return $this->checking_balance;
	}
	
	public function get_savings_balance() {
		return $this->savings_balance;
	}
	
	public function get_account_num() {
		return $this->account_num;
	}
	
	public function get_company_id() {
		return $this->company_id;
	}
	
	public function set_checking_balance($balance=0) {
		return $this->checking_balance = $balance;
	}
	
	public function set_savings_balance($balance=0) {
		return $this->savings_balance = $balance;
	}
	
	public function set_account_num($account_num=0) {
		return $this->account_num = $account_num;
	}
	
	public function set_company_id($user_id=null) {
		return $this->company_id = $user_id;
	}
	
	public function make_deposit($amount="", $type="", $account="", $userID=0) {
		$depositType = $type;
		$accountType = $account;
		$this->id = $this->bank_account_id;
		
		if($depositType == "personal") {
			$user_account = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id = '".$userID."' AND bank_account_id = '".$this->bank_account_id."' LIMIT 1;");
			$user_account[0]->id = $user_account[0]->user_account_id;
			
			if($accountType == "checking") {
				//Add deposit to checking account
				$this->set_checking_balance($this->get_checking_balance() + $amount);
				$user_account[0]->set_checking_share($user_account[0]->get_checking_share() + $amount);
			} elseif($accountType == "savings") {
				//Add deposit to savings account
				$this->set_savings_balance($this->get_savings_balance() + $amount);
				$user_account[0]->set_savings_share($user_account[0]->get_savings_share() + $amount);
			}
			//Save bank and user account after updates completed
			$this->save();
			$user_account[0]->save();
		} elseif($depositType == "company") {
			$bank_users = User_Account::find_all_bank_users($this->bank_account_id);
			
			if($accountType == "checking") {
				//Add deposit to checking account
				$this->set_checking_balance($this->get_checking_balance() + $amount);
				foreach($bank_users as $bank_user) {
					$shareDeposit = $bank_user->get_percent_share() * $amount;
					$bank_user->id = $bank_user->user_account_id;
					$bank_user->set_checking_share($bank_user->get_checking_share() + $shareDeposit);
					$bank_user->save();
				}
			} elseif($accountType == "savings") {
				//Add deposit to savings account
				$this->set_savings_balance($this->get_savings_balance() + $amount);
				foreach($bank_users as $bank_user) {
					$shareDeposit = $bank_user->get_percent_share() * $amount;
					$bank_user->id = $bank_user->user_account_id;
					$bank_user->set_savings_share($bank_user->get_savings_share() + $shareDeposit);
					$bank_user->save();
				}
			}
			//Save bank and user account after updates completed
			$this->save();
		} else {
			$message = "Deposit type not selected";
		}
	}
	
	public function make_withdrawl($amount="", $type="", $account="", $userID=0) {
		$depositType = $type;
		$accountType = $account;
		$this->id = $this->bank_account_id;

		if($depositType == "personal") {
			$user_account = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id = '".$userID."' AND bank_account_id = '".$this->bank_account_id."' LIMIT 1;");
			$user_account[0]->id = $user_account[0]->user_account_id;
			
			if($accountType == "checking") {
				//Add deposit to checking account
				$this->set_checking_balance($this->get_checking_balance() - $amount);
				$user_account[0]->set_checking_share($user_account[0]->get_checking_share() - $amount);
			} elseif($accountType == "savings") {
				//Add deposit to savings account
				$this->set_savings_balance($this->get_savings_balance() - $amount);
				$user_account[0]->set_savings_share($user_account[0]->get_savings_share() - $amount);
			}
			//Save bank and user account after updates completed
			$this->save();
			$user_account[0]->save();
		} elseif($depositType == "company") {
			$bank_users = User_Account::find_all_bank_users($this->bank_account_id);
			
			if($accountType == "checking") {
				//Add withdrawl to checking account
				$this->set_checking_balance($this->get_checking_balance() - $amount);
				foreach($bank_users as $bank_user) {
					$shareDeposit = $bank_user->get_percent_share() * $amount;
					$bank_user->id = $bank_user->user_account_id;
					$bank_user->set_checking_share($bank_user->get_checking_share() - $shareDeposit);
					$bank_user->save();
				}
			} elseif($accountType == "savings") {
				//Add withdrawl to savings account
				$this->set_savings_balance($this->get_savings_balance() - $amount);
				foreach($bank_users as $bank_user) {
					$shareDeposit = $bank_user->get_percent_share() * $amount;
					$bank_user->id = $bank_user->user_account_id;
					$bank_user->set_savings_share($bank_user->get_savings_share() - $shareDeposit);
					$bank_user->save();
				}
			}
			//Save bank and user account after updates completed
			$this->save();
		} else {
			$message = "Withdrawl type not selected";
		}
	}
	
	public function make_transfer($amount="", $type="", $to="", $account="", $userID=0) {
		$accountType = $account;
		$sendTo = $to;
		$sendFrom = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id = '".$userID."' AND bank_account_id = '".$this->bank_account_id."' LIMIT 1;");
		$this->id = $this->bank_account_id;
		
		if($type == "user") {
			$sendToUser = User_Account::find_by_sql("SELECT * FROM user_account WHERE user_id = '".$sendTo."' AND bank_account_id = '".$this->bank_account_id."'");
			if($accountType == "checking") {
				$sendFrom[0]->checking_share -= $amount;
				$sendFrom[0]->id = $sendFrom[0]->user_account_id;
				if($sendFrom[0]->save()) {
					// $session->message("<li class='okItem'>Transfer from ".$sendFrom->user." of $" .$amount. " was successful.</li>");
					$sendToUser[0]->checking_share += $amount; 
					$sendToUser[0]->id = $sendToUser[0]->user_account_id;
					if($sendToUser[0]->save()) {
						// $session->message("<li class='okItem'>Transfer to ".$sendTo->user." of $" .$amount. " was successful.</li>"); 
					}
				}
			} else {
				$sendFrom[0]->savings_share -= $amount;
				$sendFrom[0]->id = $sendFrom[0]->user_account_id;
				$this->set_checking_balance($this->get_checking_balance() + $amount);
				$this->set_savings_balance($this->get_savings_balance() - $amount);
				if($sendFrom[0]->save()) {
					// $session->message("<li class='okItem'>Transfer from ".$sendFrom->user." of $" .$amount. " was successful.</li>");
					$sendToUser[0]->checking_share += $amount;
					$sendToUser[0]->id = $sendToUser[0]->user_account_id;
					if($sendToUser[0]->save()) {
						// $session->message("<li class='okItem'>Transfer to ".$sendTo->user." of $" .$amount. " was successful.</li>");
						if($this->save()) {
						
						}
					}
				}
			}
		} else {
			if($accountType == "checking") { 
				$sendFrom[0]->checking_share -= $amount;
				$sendFrom[0]->savings_share+= $amount;
				$sendFrom[0]->id = $sendFrom[0]->user_account_id;
				$this->set_checking_balance($this->get_checking_balance() - $amount);
				$this->set_savings_balance($this->get_savings_balance() + $amount);
				if($sendFrom[0]->save()) {
					// $session->message("<li class='okItem'>Transfer to Savings Account from Checking Account was successful.</li>");
					if($this->save()) {
						
					}
				}
			} else {
				$sendFrom[0]->savings_share -= $amount;
				$sendFrom[0]->checking_share+= $amount;
				$sendFrom[0]->id = $sendFrom[0]->user_account_id;
				$this->set_checking_balance($this->get_checking_balance() + $amount);
				$this->set_savings_balance($this->get_savings_balance() - $amount);
				if($sendFrom[0]->save()) {
					// $session->message("<li class='okItem'>Transfer to Checking Account from Savings Account was successful.</li>");
					if($this->save()) {
						
					}
				}
			}
		}
	}
	
	public function make_purchase($amount="") {
		$bank_users = self::find_all_bank_users();
		
		if(!empty($bank_users)) {
			$totalUsers = count($bank_users);
			$amountSpl = $amount / $totalUsers;
			$this->checking_balance -= $amount;
			$this->id = $this->bank_account_id;

			if($this->save()) {
				$this->recreate_shares();
			} else {
				// $session->message("<li class='errorItem'>User accounts were not deducted any money.");
			}
		} else {
			return false;
		}
	}
	
	public function make_refund($amount="") {
		$bank_users = self::find_all_bank_users();
		
		if(!empty($bank_users)) {
			$totalUsers = count($bank_users);
			$amountSpl = $amount / $totalUsers;
			$this->checking_balance += $amount;
			$this->id = $this->bank_account_id;

			if($this->save()) {
				$this->recreate_shares();
			} else {
				// $session->message("<li class='errorItem'>User accounts were not deducted any money.");
			}
		} else {
			return false;
		}
	}
	
	public static function bank_name_exist($bank_name, $company) {
		$result_array = self::find_by_sql("SELECT * FROM ".static::$table_name." WHERE bank_name = '".$bank_name."' AND company_id = '".$company."';");

		if(!empty($result_array)) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function find_all_banks() {
		$result_array = self::find_by_sql("SELECT * FROM ".static::$table_name.";");
		
		if(!empty($result_array)) {
			if(count($result_array) > 1) {
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
	
	public function find_all_bank_users() {
		$result_array = self::find_by_sql("SELECT * FROM user_account WHERE ".static::$table_name."_id = '".$this->bank_account_id."';");
		
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
	
	public static function find_bank_deposit_withdrawl_diff($bankID) {
		$bankTrans = Transaction::find_by_sql("SELECT * FROM `transaction` WHERE `bank_account_id` = '".$bankID."' AND (`deposit_type` = 'personal' OR `withdrawl_type` = 'personal' OR `type` = 'Transfer')");
		$totalCheckingDiff = 0;
		$totalSavingsDiff = 0;
		foreach($bankTrans as $indTrans) {
			if($indTrans->account_type == "checking") {
				if($indTrans->type == "Deposit") {
					$totalCheckingDiff += $indTrans->amount;
				} elseif($indTrans->type == "Withdrawl") {
					$totalCheckingDiff -= $indTrans->amount;
				} elseif($indTrans->type == "Transfer") {
					if($indTrans->transfer_type == "account" && $indTrans->transfer_to == "savings") {
						$totalCheckingDiff -= $indTrans->amount;
						$totalSavingsDiff += $indTrans->amount;
					}
				}
			} elseif($indTrans->account_type == "savings") {
				if($indTrans->type == "Deposit") {
					$totalSavingsDiff += $indTrans->amount;
				} elseif($indTrans->type == "Withdrawl") {
					$totalSavingsDiff -= $indTrans->amount;
				} elseif($indTrans->type == "Transfer") {
					if($indTrans->transfer_type == "account" && $indTrans->transfer_to == "checking") {
						$totalSavingsDiff -= $indTrans->amount;
						$totalCheckingDiff += $indTrans->amount;
					}
				}
			} 
		}
		return ["savingDiff" => $totalSavingsDiff, "checkingDiff" => $totalCheckingDiff];
	}
	
	public function recreate_shares() {
		$banksTransaction = self::find_bank_deposit_withdrawl_diff($this->bank_account_id);
		$allUsers = User_Account::find_all_bank_users($this->bank_account_id);
		$usersCount = count($allUsers);
		$companyChecking = $this->get_checking_balance() - $banksTransaction['checkingDiff'];
		$companySavings = $this->get_savings_balance() - $banksTransaction['savingDiff'];

		if(count($allUsers) > 1) {
			foreach($allUsers as $indUser) {
				$personalTransaction = User_Account::find_user_deposit_withdrawl_diff($indUser->user_id, $this->bank_account_id);
				$indUser->set_checking_share(round(($companyChecking * $indUser->get_percent_share()) + $personalTransaction["checkingDiff"], 2));
				$indUser->set_savings_share(round(($companySavings * $indUser->get_percent_share()) + $personalTransaction["savingDiff"], 2));
				$indUser->id = $indUser->user_account_id;

				if($indUser->save()) {
					// $session->message("<li class='okItem'>Changes made to user " . $indUser->user . "</li>");
				} else {
					// $session->message("<li class='errorItem'>No changes made to user " . $indUser->user . "</li>");
				}
			}
			
			// Check to see if bank account total is equal to sum of users totals
			// If totals differ, then take difference from random user (Normally difference will be a penny)
			$totals = self::users_bank_account_total($this->bank_account_id);
			if($totals[savingsTotal][0]->total != $this->get_savings_balance()) {
				$differenceAmount = abs($totals[savingsTotal][0]->total - $this->get_savings_balance());
				$randomUserIndex = rand(0, $usersCount-1);
				$randomUser = $allUsers[$randomUserIndex];
				$randomUser->set_savings_share($randomUser->get_savings_share() - $differenceAmount);
				
				if($randomUser->save()) {
					
				} else {
					
				}
			} else {
				// echo "They do match";
			}
			
			if($totals[checkingTotal][0]->total != $this->get_checking_balance()) {
				$differenceAmount = abs($totals[checkingTotal][0]->total - $this->get_checking_balance());
				$randomUserIndex = rand(0, $usersCount-1);
				$randomUser = $allUsers[$randomUserIndex];
				$randomUser->set_checking_share($randomUser->get_checking_share() - $differenceAmount);
				
				if($randomUser->save()) {
					
				} else {
					
				}
			} else {
				// echo "They do match";
			}
			
		} else {
			$personalTransaction = User_Account::find_user_deposit_withdrawl_diff($allUsers[0]->user_id, $this->bank_account_id);
			$allUsers[0]->set_checking_share(round(($companyChecking * $allUsers[0]->get_percent_share()) + $personalTransaction["checkingDiff"], 2));
			$allUsers[0]->set_savings_share(round(($companySavings * $allUsers[0]->get_percent_share()) + $personalTransaction["savingDiff"], 2));
			$allUsers[0]->id = $allUsers[0]->user_account_id;
			echo"<pre>";
			print_r($personalTransaction);
			echo"</pre>";
			echo $personalTransaction['checkingDiff'];
			echo "<br/>";
			echo $personalTransaction['savingDiff'];
			if($allUsers[0]->save()) {
				// $session->message("<li class='okItem'>Changes made to user " . $allUsers[0]->user . "</li>");
			} else {
				// $session->message("<li class='errorItem'>No changes made to user " . $allUsers[0]->user . "</li>");
			}
		}
	}
	
	private function users_bank_account_total($bank=0) {
		$totalSumChecking = User_Account::find_by_sql("SELECT ROUND(SUM(checking_share) ,2) AS total FROM `user_account` WHERE bank_account_id = ".$bank.";"); 
		$totalSumSavings = User_Account::find_by_sql("SELECT ROUND(SUM(savings_share) ,2) AS total FROM `user_account` WHERE bank_account_id = ".$bank.";");
		
		return ["checkingTotal" => $totalSumChecking, "savingsTotal" => $totalSumSavings];
	}
}

?>