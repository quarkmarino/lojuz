<?php

namespace Models;

use Eloquent;

class News extends Eloquent {
	protected $fillable = array('user_id', 'title', 'message', 'since', 'until', 'status', 'product_id');

	public function author(){
		return $this->belongsTo('Models\User', 'user_id');
	}

	public function product(){
		return $this->belongsTo('Models\Product');
	}

	public function scopeActive($query){
		return $query->whereStatus(1);
	}
}