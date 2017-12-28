<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
	* Get the users associated with the company
	*/
	public function users() {
		return $this->hasMany('App\User');
	}
	
	/**
	* Get the bank accounts associated with the company
	*/
	public function bank_accounts() {
		return $this->hasMany('App\BankAccount');
	}
}
