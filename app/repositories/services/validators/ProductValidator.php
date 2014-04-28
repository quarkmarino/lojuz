<?php

namespace Repositories\Services\Validators;

class ProductValidator extends Validation{

	/**
	* Validation rules
	*/
	public static $rules = array(
		'catalog_id' => 'required|integer|exists:catalogs,id',
		'name' => 'required|alpha_num_spaces',
		'tags' => 'required',
		'type' => 'required|in:product,service',
		'price' => 'required|numeric',
		'status' => 'required|in:0,1',
	);

	/**
	* Validation messages
	*/
	//public static $messages = array();
}