<?php

namespace Models;

use Eloquent;

class Gallery extends Eloquent {
	protected $fillable = array('user_id', 'name', 'description', 'tags', 'status');

	public static function boot(){
		parent::boot();

		static::deleting(function($gallery){
			$gallery->images()->get()->each(function($image){
				$image->delete();
			});
			$path = $gallery->getImagesPath(true);
			if(\File::exists($path))
				\File::deleteDirectory($path);
		});
	}

	public function scopeActive($query){
		return $query->whereStatus(1);
	}

	public function author(){
		return $this->belongsTo('Models\User', 'user_id');
	}

	public function images(){
		return $this->hasMany('Models\Image');
	}

	public function getImagesPath($absolute = false, $imagesDir = 'images/'){
		$path = $imagesDir . 'galleries/' . $this->id . '_' . $this->name . '/';
		//dd($path);
		$abs_path = public_path() . '/' . $path;
		if( !\File::exists($abs_path) )
				\File::makeDirectory($abs_path, 0777, true, true);
		return $absolute ? $abs_path : $path;
	}
}