<?php

namespace Models;

use Eloquent;
use Intervention\Image\Facades\Image as IntrvImage;

class Client extends Eloquent {
	protected $fillable = array('unique', 'user_id', 'name', 'comment', 'since', 'status', 'logo');

	protected $root = 'images/clients';

	public static function boot(){
		parent::boot();

		/*static::saving(function($client){
			if(\Input::hasFile('logo')){
				$client->tinythumb = $client->grabImage('tinythumb', array(48, 30));
				$client->largethumb = $client->grabImage('largethumb', array(250, 185));
				$client->slide = $client->grabImage('slide', array(757, 478));
			}
		});*/

		static::saving(function($client){
			if(\Input::hasFile('logo')){
				$client->tinythumb = $client->grabImage('tinythumb', array(48, 30));
				$client->thumb = $client->grabImage('thumb', 100);
				$client->largethumb = $client->grabImage('largethumb', array(250, 185));
				$client->slide = $client->grabImage('slide', array(757, 478));
			}
		});

		static::updated(function($client){
			//dd("updated");
		});

		static::deleting(function($client){
			$path = public_path() . '/';
			if(\File::exists($path . $client->logo))
				\File::delete($path . $client->logo);
			if(\File::exists($path . $client->tinythumb))
				\File::delete($path . $client->tinythumb);
			if(\File::exists($path . $client->slide))
				\File::delete($path . $client->slide);
			if(\File::exists($path . $client->largethumb))
				\File::delete($path . $client->largethumb);
			if(\File::exists($path . $client->thumb))
				\File::delete($path . $client->thumb);
		});
	}

	public function scopeActive($query){
		return $query->whereStatus(1);
	}

	public function author(){
		return $this->belongsTo('User', 'user_id');
	}

	public function setSinceAttribute($value){
		$this->attributes['since'] = date("Y-m-d", strtotime($value));
	}

	public function getSinceAttribute($value){
		return date("d/m/Y", strtotime($value));
	}

	public function setUniqueAttribute($value){
		$this->attributes['unique'] = uniqid();
	}

	public function setLogoAttribute($value){
		if(\Input::hasFile('logo')){
			$image = IntrvImage::make( \Input::file('logo')->getRealPath() );
			//$file_path = $this->getDirPath() . \Hash::make((string)(new \DateTime)->getTimeStamp());
			$image->save($this->getDirPath(true) . $this->unique . '_' . str_replace(' ', '_', $this->name) . '_original.jpg');
			$value = $this->getDirPath() . $image->basename;
		}
		//dd($this->attributes['file'], $this->file, $value);
		$this->attributes['logo'] = $value;
	}

	public function grabImage($name = 'thumb', $resize = null, $image = null, $save = false){
		if($image === null)
			$image = IntrvImage::make( public_path() . '/' . $this->logo );

		if($resize !== null){
			if(is_array($resize))
				$image->grab($resize[0], $resize[1]);
			else
				$image->grab($resize);
		}

		//absolute path for saving
		$file_path = $this->getDirPath(true);
		$image->save($file_path . $this->unique . '_' . str_replace(' ', '_', $this->name) . '_' . $name . '.jpg');

		//realtive path for storing in db build from dirpath and saved file name
		$image_fullname = $this->getDirPath() . $image->basename;
		$this->attributes[$name] = $image_fullname;

		if($save)
			$this->save();
		return $image_fullname;
	}

	public function getDirPath($absolute = false){
		$path = $this->root . '/';
		//prepend public path
		$abs_path = public_path() . '/' . $path;
		if( !\File::exists($abs_path) )
				\File::makeDirectory($abs_path, 0777, true, true);
		return $absolute ? $abs_path : $path;
	}

}