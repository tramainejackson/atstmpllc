<?php

namespace App;

use App\BankAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccount extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
	* Get the user associated with the user account
	*/
	public function user() {
		return $this->belongsTo('App\User');
	}
	
	/**
	* Get the bank account associated with the user_account
	*/
	public function bank_account() {
		return $this->belongsTo('App\BankAccount');
	}
	
	/**
	* Get the transactions associated with the user account
	*/
	public function transactions() {
		return $this->hasMany('App\Transaction');
	}
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'bank_account_id', 'edit_bank'
    ];
	
	public function make_deposit($amount=0, $type="", $account="", $user_account=0) {
		$user_account = UserAccount::find($user_account);
		$bank = BankAccount::find($user_account->bank_account->id);
		$depositType = $type;
		$accountType = $account;
		$message = "";
		
		if($depositType == "personal") {
			if($accountType == "checking") {
				//Add deposit to checking account
				$bank->checking_balance = $bank->checking_balance + $amount;
				$user_account->checking_share = $user_account->checking_share + $amount;
			} elseif($accountType == "savings") {
				//Add deposit to savings account
				$bank->savings_balance = $bank->savings_balance + $amount;
				$user_account->savings_share = $user_account->savings_share + $amount;
			}
		} elseif($depositType == "company") {
			$bank_users = $bank->user_accounts;
			
			if($accountType == "checking") {
				//Add deposit to checking account
				$bank->checking_balance = $bank->checking_balance + $amount;
				foreach($bank_users as $bank_user) {
					$shareDeposit = $bank_user->share_pct * $amount;
					$bank_user->checking_share = $bank_user->checking_share + $shareDeposit;
					$bank_user->save();
				}
			} elseif($accountType == "savings") {
				//Add deposit to savings account
				$bank->savings_balance = $bank->savings_balance + $amount;
				foreach($bank_users as $bank_user) {
					$shareDeposit = $bank_user->share_pct * $amount;
					$bank_user->savings_share  = $bank_user->savings_share + $shareDeposit;
					$bank_user->save();
				}
			}
			
			//Save bank and user account after updates completed
		} else {
			$message = "Deposit type not selected";
			return $message;
		}
		
		$bank->save();
		$user_account->save();
	}
	
	public function make_withdrawl($amount=0, $type="", $user_account=0) {
		$user_account = UserAccount::find($user_account);
		$bank = BankAccount::find($user_account->bank_account->id);
		$withdrawlType = $type;
		$message = "";
		// dd($user_account);

		if($withdrawlType == "personal") {			
			// Make withdrawl to checking account
			$bank->checking_balance = $bank->checking_balance - $amount;
			$user_account->checking_share = $user_account->checking_share - $amount;
		} elseif($withdrawlType == "company") {
			$bank_users = $bank->user_accounts;
			
			// Make withdrawl to checking account
			$bank->checking_balance = $bank->checking_balance + $amount;
			foreach($bank_users as $bank_user) {
				$shareDeposit = $bank_user->share_pct * $amount;
				$bank_user->checking_share = $bank_user->checking_share - $shareDeposit;
				$bank_user->save();
			}
		} else {
			$message = "<li class='errorItem'>Withdrawl type not selected</li>";
			return $message;
		}
		
		$bank->save();
		$user_account->save();
	}
	
	public function make_purchase($amount=0, $user_account=0) {
		$user_account = UserAccount::find($user_account);
		$bank = BankAccount::find($user_account->bank_account->id);
		$bank->checking_balance -= $amount;
		$bank_users = $bank->user_accounts;
		
		if($bank_users->count() > 1) {
			if($bank->save()) {
				// $bank->recreate_shares();
			} else {
				// $session->message("<li class='errorItem'>User accounts were not deducted any money.");
			}
		} else {
			$user_account->checking_share -= $amount;
			if($user_account->save()) {
				$bank->save();
			}
		}
	}

	public function make_transfer($amount=0, $type="", $to="", $fromAccount="", $user_account=0) {
		$accountType = $fromAccount;
		$sendTo = is_numeric($to) ? UserAccount::where('user_id', $to)->first() : $to;
		$sendFrom = UserAccount::find($user_account);
		$bank = BankAccount::find($sendFrom->bank_account->id);
		
		if($type == "user") {
			if($accountType == "checking") {
				$sendFrom->checking_share -= $amount;

				if($sendFrom->save()) {
					// $session->message("<li class='okItem'>Transfer from ".$sendFrom->user." of $" .$amount. " was successful.</li>");
					$sendTo->checking_share += $amount; 
					if($sendToUser->save()) {
						// $session->message("<li class='okItem'>Transfer to ".$sendTo->user." of $" .$amount. " was successful.</li>"); 
					}
				}
			} else {
				$sendFrom->savings_share -= $amount;
				$bank->checking_balance += $amount;
				$bank->savings_balance -= $amount;
				if($sendFrom->save()) {
					// $session->message("<li class='okItem'>Transfer from ".$sendFrom->user." of $" .$amount. " was successful.</li>");
					$sendToUser->checking_share += $amount;
					if($sendToUser->save()) {
						// $session->message("<li class='okItem'>Transfer to ".$sendTo->user." of $" .$amount. " was successful.</li>");
						if($bank->save()) {
						
						}
					}
				}
			}
		} else {
			if($accountType == "checking") { 
				$sendFrom->checking_share -= $amount;
				$sendFrom->savings_share += $amount;
				$bank->checking_balance -= $amount;
				$bank->savings_balance += $amount;
				if($sendFrom->save()) {
					// $session->message("<li class='okItem'>Transfer to Savings Account from Checking Account was successful.</li>");
					if($bank->save()) {
						
					}
				}
			} else {
				$sendFrom->savings_share -= $amount;
				$sendFrom->checking_share += $amount;
				$bank->checking_balance += $amount;
				$bank->savings_balance -= $amount;
				if($sendFrom->save()) {
					// $session->message("<li class='okItem'>Transfer to Checking Account from Savings Account was successful.</li>");
					if($bank->save()) {
						
					}
				}
			}
		}
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
