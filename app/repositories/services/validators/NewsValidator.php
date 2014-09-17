<?php

namespace Repositories\Services\Validators;

class NewsValidator extends Validation{

	/**
	* Validation rules
	*/
	public static $rules = array(
		'title' => 'required|alpha_num_spaces',
		'message' => 'required',
		'since' => 'date',
		'until' => 'date',
		'status' => 'required|in:0,1',
	);

	/**
	* Validation messages
	*/
	//public static $messages = array();
}