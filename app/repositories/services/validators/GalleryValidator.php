<?php

namespace Repositories\Services\Validators;

class GalleryValidator extends Validation{

	/**
	* Validation rules
	*/
	public static $rules = array(
		'name' => 'required|alpha_spaces|max:32',
		'email' => 'required|email|max:32',
		'phone' => 'alpha_dash|max:16',
		'newsletters' => 'in:0,1',
		'company' => 'alpha_num_spaces|max:32|min:4',
	);

	/**
	* Validation messages
	*/
	public static $messages = array(
		//'alpha_num' => 'El :attribute debe contener solo caracteres alfanumericos.',
		'max' => 'El :attribute puede ser de maximo :max caracteres.',
		'newsletters.in' => 'El parametro de suscripcion solo puede tener valores [:values]',
	);
}