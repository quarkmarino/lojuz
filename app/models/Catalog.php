<?php

namespace Models;

use Eloquent;

class Catalog extends Eloquent {
	protected $fillable = array();

	public function products(){
		return $this->belongsToMany('Product');
	}

	public function author(){
		return $this->belongsTo('User', 'user_id');
	}

}