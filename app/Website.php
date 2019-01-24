<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Website extends Authenticatable
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
        'name', 'link', 'owner', 'logo', 'renew_date'
    ];
	
	/**
	* Get the name of the website
	*/
	public function getNameAttribute($value) {
		return ucfirst(strtolower($value));
	}

	/**
	* Get the link of the website
	*/
	public function getLinkAttribute($value) {
		return strtolower($value);
	}

	/**
	* Get the owner of the website
	*/
	public function getOwnerAttribute($value) {
		return ucwords(strtolower($value));
	}

	/**
	* Set the name of the website
	*/
	public function setNameAttribute($value) {
		$this->attributes['name'] = ucfirst(strtolower($value));
	}

	/**
	* Set the link of the website
	*/
	public function setLinkAttribute($value) {
		$this->attributes['link'] = strtolower($value);
	}

	/**
	* Set the owner of the website
	*/
	public function setOwnerAttribute($value) {
		$this->attributes['owner'] = ucwords(strtolower($value));
	}

}
