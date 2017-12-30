<?php

namespace App;

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
	
	public function recreate_shares() {
		// $banksTransaction = self::find_bank_deposit_withdrawl_diff($this->bank_account_id);
		// $allUsers = User_Account::find_all_bank_users($this->bank_account_id);
		// $usersCount = count($allUsers);
		// $companyChecking = $this->get_checking_balance() - $banksTransaction['checkingDiff'];
		// $companySavings = $this->get_savings_balance() - $banksTransaction['savingDiff'];

		// if(count($allUsers) > 1) {
			// foreach($allUsers as $indUser) {
				// $personalTransaction = User_Account::find_user_deposit_withdrawl_diff($indUser->user_id, $this->bank_account_id);
				// $indUser->set_checking_share(round(($companyChecking * $indUser->get_percent_share()) + $personalTransaction["checkingDiff"], 2));
				// $indUser->set_savings_share(round(($companySavings * $indUser->get_percent_share()) + $personalTransaction["savingDiff"], 2));
				// $indUser->id = $indUser->user_account_id;

				// if($indUser->save()) {
					// // $session->message("<li class='okItem'>Changes made to user " . $indUser->user . "</li>");
				// } else {
					// // $session->message("<li class='errorItem'>No changes made to user " . $indUser->user . "</li>");
				// }
			// }
			
			// // Check to see if bank account total is equal to sum of users totals
			// // If totals differ, then take difference from random user (Normally difference will be a penny)
			// $totals = self::users_bank_account_total($this->bank_account_id);
			// if($totals[savingsTotal][0]->total != $this->get_savings_balance()) {
				// $differenceAmount = abs($totals[savingsTotal][0]->total - $this->get_savings_balance());
				// $randomUserIndex = rand(0, $usersCount-1);
				// $randomUser = $allUsers[$randomUserIndex];
				// $randomUser->set_savings_share($randomUser->get_savings_share() - $differenceAmount);
				
				// if($randomUser->save()) {
					
				// } else {
					
				// }
			// } else {
				// // echo "They do match";
			// }
			
			// if($totals[checkingTotal][0]->total != $this->get_checking_balance()) {
				// $differenceAmount = abs($totals[checkingTotal][0]->total - $this->get_checking_balance());
				// $randomUserIndex = rand(0, $usersCount-1);
				// $randomUser = $allUsers[$randomUserIndex];
				// $randomUser->set_checking_share($randomUser->get_checking_share() - $differenceAmount);
				
				// if($randomUser->save()) {
					
				// } else {
					
				// }
			// } else {
				// // echo "They do match";
			// }
			
		// } else {
			// $personalTransaction = User_Account::find_user_deposit_withdrawl_diff($allUsers[0]->user_id, $this->bank_account_id);
			// $allUsers[0]->set_checking_share(round(($companyChecking * $allUsers[0]->get_percent_share()) + $personalTransaction["checkingDiff"], 2));
			// $allUsers[0]->set_savings_share(round(($companySavings * $allUsers[0]->get_percent_share()) + $personalTransaction["savingDiff"], 2));
			// $allUsers[0]->id = $allUsers[0]->user_account_id;
			// echo"<pre>";
			// print_r($personalTransaction);
			// echo"</pre>";
			// echo $personalTransaction['checkingDiff'];
			// echo "<br/>";
			// echo $personalTransaction['savingDiff'];
			// if($allUsers[0]->save()) {
				// // $session->message("<li class='okItem'>Changes made to user " . $allUsers[0]->user . "</li>");
			// } else {
				// // $session->message("<li class='errorItem'>No changes made to user " . $allUsers[0]->user . "</li>");
			// }
		// }
	}
}
