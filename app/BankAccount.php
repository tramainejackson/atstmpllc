<?php

namespace App;

use App\UserAccount;
use App\User;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
	* Get the company associated with the bank account
	*/
	public function company() {
		return $this->belongsTo('App\Company');
	}
	
	/**
	* Get the user accounts associated with the bank account
	*/
	public function user_accounts() {
		return $this->hasMany('App\UserAccount');
	}
	
	/**
	* Get the transactions associated with the bank account
	*/
	public function transactions() {
		return $this->hasMany('App\Transaction');
	}
	
	public function make_deposit($amount=0, $type="") {
		$bank = $this;
		$accountType = $type;
		$message = "";
		
		if($accountType == "checking") {
			//Add deposit to checking account
			$bank->checking_balance += $amount;
		} elseif($accountType == "savings") {
			//Add deposit to savings account
			$bank->savings_balance += $amount;
		}
		
		if($bank->save()) {
			$this->recreate_shares();
		}
	}
	
	public function make_withdrawl($amount=0, $type="") {
		$bank = $this;
		$accountType = $type;
		$message = "";
	
		// Remove withdrawl amount from checking account
		$bank->checking_balance -= $amount;

		if($bank->save()) {
			$this->recreate_shares();
		}
	}
	
	public function make_purchase($amount=0) {
		$bank = $this;
		$bank->checking_balance -= $amount;
		
		if($bank->save()) {
			$bank->recreate_shares();
		} else {
			// $session->message("<li class='errorItem'>User accounts were not deducted any money.");
		}
	}

	public function make_transfer($amount=0, $type="", $to="", $fromAccount="", $user_account=0) {
		$accountType = $fromAccount;
		$sendTo = is_numeric($to) ? $this->user_accounts->where('id', $to)->first() : $to;
		$sendFrom = UserAccount::find($user_account);
		$bank = BankAccount::find($sendFrom->bank_account->id);
		// dd($sendTo);
		
		if($type == "user") {
			if($accountType == "checking") {
				$sendFrom->checking_share -= $amount;

				if($sendFrom->save()) {
					// $session->message("<li class='okItem green progress-bar-striped'>Transfer from ".$sendFrom->user." of $" .$amount. " was successful.</li>");
					$sendTo->checking_share += $amount; 
					if($sendTo->save()) {
						// $session->message("<li class='okItem green progress-bar-striped'>Transfer to ".$sendTo->user." of $" .$amount. " was successful.</li>"); 
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
					// $session->message("<li class='okItem green progress-bar-striped'>Transfer to Savings Account from Checking Account was successful.</li>");
					if($bank->save()) {
						
					}
				}
			} else {
				$sendFrom->savings_share -= $amount;
				$sendFrom->checking_share += $amount;
				$bank->checking_balance += $amount;
				$bank->savings_balance -= $amount;
				if($sendFrom->save()) {
					// $session->message("<li class='okItem green progress-bar-striped'>Transfer to Checking Account from Savings Account was successful.</li>");
					if($bank->save()) {
						
					}
				}
			}
		}
	}
	
	public function recreate_shares() {
		$bank_users = $this->user_accounts;
		$bank_withdrawls_personal = $this->transactions()->where('withdrawl_type', 'personal')->sum('amount');
		$this->checking_balance += $bank_withdrawls_personal;
		foreach($bank_users as $bank_user) {
			$transfers_out = $bank_user->transactions()->where([
				['transfer_type', 'user'],
				['transfer_to', '<>', $bank_user->id],
			])->get();
			
			$transfers_in = $this->transactions()->where([
				['transfer_type', 'user'],
				['transfer_to', $bank_user->id]
			])->get();
			
			$personal_withdrawls = $bank_user->transactions()->where([
				['type', 'Withdrawl'],
				['withdrawl_type', 'personal']
			])->get();
			
			// Get the balances that each user account should have
			// in reference to the share percentage
			$bank_user->checking_share = $this->checking_balance * $bank_user->share_pct;
			$bank_user->savings_share = $this->savings_balance * $bank_user->share_pct;

			// Reallocate the difference in the transfers to the
			// users account
			foreach($transfers_in as $in) {
				$bank_user->checking_share += $in->amount;
			}
			
			// Reallocate the difference in the transfers from the
			// users account
			foreach($transfers_out as $out) {
				$bank_user->checking_share -= $out->amount;
			}
			
			// Reallocate the difference in the personal withdrawls from the
			// users account
			foreach($personal_withdrawls as $pw) {
				$bank_user->checking_share -= $pw->amount;
			}

			if($bank_user->save()) {
				// $session->message("<li class='okItem green progress-bar-striped'>Changes made to user " . $indUser->user . "</li>");
			} else {
				// $session->message("<li class='errorItem'>No changes made to user " . $indUser->user . "</li>");
			}
		}
	}

}
