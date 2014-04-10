<?php

namespace Models;

use Eloquent;

class Image extends Eloquent {
	protected $fillable = array();

	public function product(){
		return $this->belongsTo('Product');
	}

	public function gallery(){
		return $this->belongsTo('Gallery');
	}
}