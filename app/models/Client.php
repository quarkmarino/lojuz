<?php

namespace Models;

use Eloquent;

class Client extends Eloquent {
	protected $fillable = array();

	public function author(){
		return $this->belongsTo('User', 'user_id');
	}
}