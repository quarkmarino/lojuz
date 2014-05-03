<?php

namespace Repositories\Services\Validators;

class ImageValidator extends Validation{

	/**
	* Validation rules
	*/
	public static $rules = array(
		'catalog_id' => 'integer|exists:catalogs,id',
		'product_id' => 'integer|exists:products,id',
		'gallery_id' => 'integer|exists:galleries,id',
		'name' => 'required|alpha_num_spaces',
		'comment' => 'required',
		'status' => 'integer|in:0,1',
		'file' => 'image|max:12000000'
	);

	/**
	* Validation messages
	*/
	//public static $messages = array();
}