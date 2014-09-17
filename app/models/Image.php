<?php

namespace Models;

use Eloquent;
use Intervention\Image\Facades\Image as IntrvImage;

class Image extends Eloquent {
	protected $fillable = array();

	protected $guarded = array();  // Important

	protected $touches = array('product', 'gallery');

	protected $root = 'images/';

	public static function boot(){
		parent::boot();

		static::saving(function($image){
			if(\Input::hasFile('file')){
				$image->largethumb = $image->grabImage('largethumb', array(250, 185));
				$image->thumb = $image->grabImage('thumb', 100);
				$image->minithumb = $image->grabImage('minithumb', array(40, 30));
				$image->slide = $image->grabImage('slide', array(757, 478));
			}
		});

		static::updated(function($image){
			//dd("updated");
		});

		static::deleting(function($image){
			$path = $image->getDirPath(true);
			if(\File::exists($path))
				\File::deleteDirectory($path);
		});
	}

	public function scopeActive($query){
		return $query->whereStatus(1);
	}

	public function catalog(){
		return $this->belongsTo('Models\Catalog');
	}

	public function product(){
		return $this->belongsTo('Models\Product');
	}

	public function gallery(){
		return $this->belongsTo('Models\Gallery');
	}

	public function setNameAttribute($value){
		$this->attributes['name'] = ucfirst($value);
	}

	public function setDirnameAttribute($value){
		$this->attributes['dirname'] = uniqid();
	}

	public function setFileAttribute($value){
		if(\Input::hasFile('file')){
			$image = IntrvImage::make( \Input::file('file')->getRealPath() );
			//$file_path = $this->getDirPath() . \Hash::make((string)(new \DateTime)->getTimeStamp());
			$image->save($this->getDirPath(true) . 'original.jpg');
			$value = $this->getDirPath() . $image->basename;
		}
		//dd($this->attributes['file'], $this->file, $value);
		$this->attributes['file'] = $value;
	}

	/*public function setLargethumbAttribute($value){
		if(\Input::hasFile('largethumb')){
			$image = IntrvImage::make( \Input::file('largethumb')->getRealPath() );
			$value = $this->grabImage('largethumb', array(250, 185), $image);
		}
		$this->attributes['largethumb'] = $value;
	}*/

	public function getLargethumbAttribute($value){
		if($this->attributes['largethumb'] == null){
			$value = $this->root.'no-image-largethumb.jpg';
			//$value = $this->grabImage('largethumb', 60, true);
		}
		return $value;
	}
	
	/*public function setThumbAttribute($value){
		if(\Input::hasFile('thumb')){
			$image = IntrvImage::make( \Input::file('thumb')->getRealPath() );
			$value = $this->grabImage('thumb', array(100), $image);
		}
		$this->attributes['thumb'] = $value;
	}*/

	/*public function getThumbAttribute($value){
		if($this->attributes['thumb'] == null){
			$value = $this->root.'no-image-thumb.jpg';
			//$value = $this->grabImage('thumb', 100, true);
		}
		return $value;
	}*/

	/*public function setMinithumbAttribute($value){
		if(\Input::hasFile('minithumb')){
			$image = IntrvImage::make( \Input::file('minithumb')->getRealPath() );
			$value = $this->grabImage('minithumb', array(40, 30), $image);
		}
		$this->attributes['minithumb'] = $value;
	}*/

	/*public function getMinithumbAttribute($value){
		if($this->attributes['minithumb'] == null){
			$value = $this->root.'no-image-minithumb.jpg';
			//$value = $this->grabImage('minithumb', 60, true);
		}
		return $value;
	}*/

	/*public function setSlideAttribute($value){
		if(\Input::hasFile('slide')){
			$image = IntrvImage::make( \Input::file('slide')->getRealPath() );
			$value = $this->grabImage('slide', array(757, 360), $image);
		}
		$this->attributes['slide'] = $value;
	}*/

	/*public function getSlideAttribute($value){
		if($this->attributes['slide'] == null){
			$value = $this->root.'no-image-slide.jpg';
			//$value = $this->grabImage('slide', array(757, 360), true);
		}
		return $value;
	}*/

	public function setTagsAttribute($value){
		$tags = explode(',', $value);
		$i = 0;
		$tags2 = array();
		foreach($tags as $key => $tag){
			if(!empty($tag))
				$tags2[$i++] = ucfirst(strtolower(trim($tag)));
		}
		$this->attributes['tags'] = implode(', ', $tags2);
	}

	public function grabImage($name = 'thumb', $resize = null, $image = null, $save = false){

		if($image === null)
			$image = IntrvImage::make( public_path() . '/' . $this->file );

		if($resize !== null){
			if(is_array($resize))
				$image->grab($resize[0], $resize[1]);
			else
				$image->grab($resize);
		}

		$file_path = $this->getDirPath(true);
		$image->save($file_path . "$name.jpg");

		$image_fullname = $this->getDirPath() . $image->basename;
		$this->attributes[$name] = $image_fullname;

		if($save)
			$this->save();
		return $image_fullname;
	}

	public function getDirPath($absolute = false){
		if($this->catalog_id !== NULL)
			$path = $this->catalog->getImagesPath();
		elseif($this->product_id !== NULL)
			$path = $this->product->getImagesPath();
		elseif($this->gallery_id !== NULL)
			$path = $this->gallery->getImagesPath();

		$path .=  $this->dirname . '/';
		$abs_path = public_path() . '/' . $path;
		if( !\File::exists($abs_path) )
				\File::makeDirectory($abs_path, 0777, true, true);
		return $absolute ? $abs_path : $path;
	}
}