<?php

namespace Models;

use Eloquent;

class Product extends Eloquent {

	protected $fillable = array('catalog_id', 'name', 'description', 'tags', 'type', 'price', 'status');

	public static function boot(){
		parent::boot();
		
		static::deleting(function($product){
			$product->images()->delete();
			$path = $product->getImagesPath(true);
			if(\File::exists($path))
				\File::deleteDirectory($path);
		});
	}	

	public function scopeActive($query){
		return $query->whereStatus(1);
	}

	public function catalogs(){
		return $this->belongsToMany('Models\Catalog');
	}

	public function catalog(){
		return $this->belongsTo('Models\Catalog');
	}

	public function images(){
		return $this->hasMany('Models\Image');
	}

	public function scopeAuthoredBy($query, $author_id){
		$query->whereUserId($author_id);
	}

	public function scopeImagesCount($query){
		$query->whereUserId($author_id);
	}

	public function setTagsAttribute($value){
		$tags = explode(',', $value);
		$i = 0;
		foreach($tags as $key => $tag){
			if(!empty($tag))
				$tags2[$i++] = ucfirst(strtolower(str_replace(' ', '_', trim($tag))));
		}
		$this->attributes['tags'] = implode(', ', $tags2);
	}

	public function setNameAttribute($value){
		$this->attributes['name'] = ucfirst($value);
	}
	
	public function getImagesPath($absolute = false, $imagesDir = 'images/'){
		$path = $imagesDir . 'products/' . $this->id . '_' . $this->name . '/';
		//dd($path);
		$abs_path = public_path() . '/' . $path;
		if( !\File::exists($abs_path) )
				\File::makeDirectory($abs_path, 0777, true, true);
		return $absolute ? $abs_path : $path;
	}
}