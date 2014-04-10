<?php

namespace Models;

use Eloquent;

class News extends Eloquent {
	protected $fillable = array();

	public function author(){
		return $this->belongsTo('User', 'user_id');
	}

	public function product(){
		return $this->belongsTo('product');
	}
}