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

	public function find_user_deposit_withdrawl_diff($bankAccountID) {
		$userTrans = Transaction::where('user_account_id', $this->id)->get();

		$totalCheckingDiff = 0;
		$totalSavingsDiff = 0;
		
		foreach($userTrans as $indTrans) {
			if($indTrans->type == "Deposit" && $indTrans->deposit_type == "personal") {
				if($indTrans->account_type == "checking") {
					$totalCheckingDiff += $indTrans->amount;
				} elseif($indTrans->account_type == "savings") {
					$totalSavingsDiff += $indTrans->amount;
				}
			} elseif($indTrans->type == "Withdrawl" && $indTrans->withdrawl_type == "personal") {
				if($indTrans->account_type == "checking") {
					$totalCheckingDiff -= $indTrans->amount;
				} elseif($indTrans->account_type == "savings") {
					$totalSavingsDiff -= $indTrans->amount;
				}
			} elseif($indTrans->type == "Transfer") {
				if($indTrans->transfer_type == "account") {
					if($indTrans->transfer_from == "savings") {
						$totalCheckingDiff += $indTrans->amount;			
						$totalSavingsDiff -= $indTrans->amount;
					} elseif($indTrans->transfer_from == "checking") {
						$totalCheckingDiff -= $indTrans->amount;
						$totalSavingsDiff += $indTrans->amount;
					}
				} elseif($indTrans->transfer_type == "user") {
					if($indTrans->transfer_to == $this->id) {
						$totalCheckingDiff += $indTrans->amount;
					} else {
						if($indTrans->transfer_from == "checking") {
							$totalCheckingDiff -= $indTrans->amount;
						} elseif($indTrans->transfer_from == "savings") {
							$totalSavingsDiff -= $indTrans->amount;
						}
					}
				}
			}
		// dd($totalCheckingDiff);
		}
		
		return ["savingDiff" => $totalSavingsDiff, "checkingDiff" => $totalCheckingDiff];
	}

}
