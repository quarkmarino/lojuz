<?php

namespace Repositories\Services\Validators;

class ClientValidator extends Validation{

	/**
	* Validation rules
	*/
	public static $rules = array(
		'name' => 'required|alpha_num_spaces',
		'comment' => 'required',
		'since' => 'date',
		'status' => 'required|in:0,1',
		'logo' => 'image|max:12000000',
	);

	/**
	* Validation messages
	*/
	//public static $messages = array();
}