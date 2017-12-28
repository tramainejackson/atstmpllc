<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
	* Get the user account associated with the transaction
	*/
	public function user_account() {
		return $this->belongsTo('App\UserAccount');
	}
	
	/**
	* Get the bank account associated with the transaction
	*/
	public function bank_account() {
		return $this->belongsTo('App\BankAccount');
	}
}
