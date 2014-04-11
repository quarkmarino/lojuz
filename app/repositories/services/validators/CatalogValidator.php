<?php

namespace Repositories\Services\Validators;

class CatalogValidator extends Validation{

	/**
	* Validation rules
	*/
	public static $rules = array(
		'attendant_id' => 'in:1,2,3,4',
		'dispatch' => 'required',
		//'recaptcha_response_field' => 'required|recaptcha',
	);

	/**
	* Validation messages
	*/
	public static $messages = array(
		'alpha_num' => 'El :attribute debe contener solo caracteres alfanumericos.',
		'max' => 'El :attribute puede ser de maximo :max caracteres.',
	);
}