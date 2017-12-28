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
}
