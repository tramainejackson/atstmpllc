<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'username', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'company_id'
    ];
	
	/**
	* Get the company associated with the user
	*/
	public function company() {
		return $this->belongsTo('App\Company');
	}
	
	/**
	* Get the user accounts associated with the user
	*/
	public function user_accounts() {
		return $this->hasMany('App\UserAccount');
	}
	
	/**
	* Get the transactions associated with the user
	*/
	public function transactions() {
		return $this->hasMany('App\Transaction');
	}
	
	public function full_name() {
		return $this->firstname . " " . $this->lastname;
	}
}
