<?php

namespace Repositories\Services\Validators;

class MessageValidator extends Validation{

	/**
	* Validation rules
	*/
	public static $rules = array(
		'name' => 'required|alpha_num_spaces',
		'email' => 'required|email',
		'message' => 'required|alpha_num_spaces',
		'attendant' => 'in:0,1,2,3',
		'recaptcha_response_field' => 'required|recaptcha',
	);

	/**
	* Validation messages
	*/
	//public static $messages = array();
}