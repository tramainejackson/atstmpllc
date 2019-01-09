<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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
	 * Get the transaction date.
	 *
	 * @param  string  $value
	 * @return Carbon/Carbon Object
	 */
	public function getTransactionDateAttribute($value)
	{
		return $value == null ? $value : new Carbon($value);
	}

	/**
	 * Set the first name for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function setTypeAttribute($value)
	{
		$this->attributes['type'] = ucfirst($value);
	}

	/**
	* Get the user account associated with the transaction
	*/
	public function user() {
		return $this->belongsTo('App\User');
	}
	
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
