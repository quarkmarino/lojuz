<?php

namespace Repositories\Services\Validators;

class CatalogValidator extends Validation{

	/**
	* Validation rules
	*/
	public static $rules = array(
		'name' => 'required|alpha_num_spaces',
		'tags' => 'required',
		'status' => 'required|in:0,1'
	);

	/**
	* Validation messages
	*/
	//public static $messages = array();
}