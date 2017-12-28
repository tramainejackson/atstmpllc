<?php

namespace App;

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
}
