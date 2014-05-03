<?php

namespace Models;

use Eloquent;

class Catalog extends Eloquent {
	protected $fillable = array('user_id', 'name', 'tags', 'description', 'status');

	public static function boot(){
		parent::boot();

		static::deleting(function($catalog){
			$catalog->products()->get()->each(function($product){
				$product->delete();
			});
			if($catalog->image !== null)
				$catalog->image->delete();
			$path = $catalog->getImagesPath(true);
			if(\File::exists($path))
				\File::deleteDirectory($path);
		});
	}

	/*public function products(){
		return $this->belongsToMany('Models\Product');
	}*/

	public function products(){
		return $this->hasMany('Models\Product');
	}

	public function author(){
		return $this->belongsTo('Models\User', 'user_id');
	}

	public function image(){
		return $this->hasOne('Models\Image');
	}

	public function setNameAttribute($value){
		$this->attributes['name'] = ucfirst($value);
	}

	public function setTagsAttribute($value){
		$tags = explode(',', $value);
		$i = 0;
		foreach($tags as $key => $tag){
			if(!empty($tag))
				$tags2[$i++] = ucfirst(strtolower(trim($tag)));
		}
		$this->attributes['tags'] = implode(', ', $tags2);
	}

	public function getImagesPath($absolute = false, $imagesDir = 'images/'){
		$path = $imagesDir . 'catalogs/' . $this->id . '_' . $this->name . '/';
		//dd($path);
		$abs_path = public_path() . '/' . $path;
		if( !\File::exists($abs_path) )
				\File::makeDirectory($abs_path, 0777, true, true);
		return $absolute ? $abs_path : $path;
	}
}