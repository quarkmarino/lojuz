<?php

namespace Models;

use Eloquent;

class Gallery extends Eloquent {
	protected $fillable = array();

	public function author(){
		return $this->belongsTo('User', 'user_id');
	}

	public function images(){
		return $this->hasMany('Image');
	}
}