<?php

namespace Models;

use Eloquent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array();

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function news(){
		return $this->hasMany('News');
	}

	public function clients(){
		return $this->hasMany('Client');
	}

	public function galleries(){
		return $this->hasMany('Gallery');
	}

	public function catalogs(){
		return $this->hasMany('Catalog');
	}

	/**
	 * machuga/authority-l4 roles and permissions relations for user model
	 */

	public function roles() {
        return $this->belongsToMany('Role');
    }

    public function permissions() {
        return $this->hasMany('Permission');
    }

    public function hasRole($key) {
        foreach($this->roles as $role){
            if($role->name === $key)
            {
                return true;
            }
        }
        return false;
    }

}