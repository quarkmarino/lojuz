<?php

namespace Models;

use Eloquent;

class Product extends Eloquent {
	protected $fillable = array();

	public function catalogs(){
		return $this->belongsToMany('Catalog');
	}

	public function images(){
		return $this->hasMany('Image');
	}

	public function scopeAuthoredBy($query, $author_id){
		$query->whereUserId($author_id);
	}
}