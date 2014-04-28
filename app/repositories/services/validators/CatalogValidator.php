<?php

namespace Repositories\Services\Validators;

class CatalogValidator extends Validation{

	/**
	* Validation rules
	*/
	public static $rules = array(
		'name' => 'required|alpha_num_spaces',
		'tags' => 'required',
	);

	/**
	* Validation messages
	*/
	//public static $messages = array();
}