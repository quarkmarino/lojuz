<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "El :attribute debe ser aceptado.",
	"active_url"       => "El :attribute no es una URL valida.",
	"after"            => "El :attribute debe ser una fecha posterior :date.",
	"alpha"            => "El :attribute solo puede contener letras.",
	"alpha_dash"       => "El :attribute solo puede contener letras, numeros, y guiones.",
	"alpha_num"        => "El :attribute solo puede contener letras y numeros.",
	"alpha_spaces"     => "El :attribute solo puede contener letras y spaces.",
	"alpha_num_spaces" => "El :attribute solo puede contener letras, numeros y spaces.",
	"array"            => "El :attribute debe ser un arreglo.",
	"before"           => "El :attribute debe ser una fecha previa :date.",
	"between"          => array(
		"numeric" => "El :attribute debe ser entre :min y :max.",
		"file"    => "El :attribute debe ser entre :min y :max kilobytes.",
		"string"  => "El :attribute debe ser entre :min y :max characters.",
		"array"   => "El :attribute debe tener entre :min y :max elementos.",
	),
	"confirmed"        => "La confirmación para :attribute no concuerda.",
	"date"             => "El :attribute no es una fecha valida.",
	"date_format"      => "El :attribute no concuerda con el formato :format.",
	"different"        => "El :attribute y :other deben ser diferentes.",
	"digits"           => "El :attribute debe ser :digits digitos.",
	"digits_between"   => "El :attribute debe ser entre :min y :max digits.",
	"email"            => "El formato de :attribute es invalido.",
	"exists"           => "El selected :attribute es invalido.",
	"image"            => "El :attribute debe ser una imagen.",
	"in"               => "El :attribute seleccionado es invalido.",
	"integer"          => "El :attribute debe ser un entero.",
	"ip"               => "El :attribute debe ser una direccion IP valida.",
	"max"              => array(
		"numeric" => "El :attribute no puede ser mayor a :max.",
		"file"    => "El :attribute no puede ser mayor a :max kilobytes.",
		"string"  => "El :attribute no puede ser mayor a :max characters.",
		"array"   => "El :attribute no puede tener mas de :max elementos.",
	),
	"mimes"            => "El :attribute debe ser un archivo de typo: :values.",
	"min"              => array(
		"numeric" => "El :attribute debe ser de al menos :min.",
		"file"    => "El :attribute debe ser de al menos :min kilobytes.",
		"string"  => "El :attribute debe ser de al menos :min characters.",
		"array"   => "El :attribute debe tener al menos :min elementos.",
	),
	"not_in"           => "El :attribute seleccionado es invalido.",
	"numeric"          => "El :attribute debe ser un numero.",
	"regex"            => "El format de :attribute es invalido.",
	"required"         => "El campo :attribute es requerido.",
	"required_if"      => "El campo :attribute es requerido cuando :other es :value.",
	"required_with"    => "El campo :attribute es requerido cuando :values esta presente.",
	"required_without" => "El campo :attribute es requerido cuando :values no esta presente.",
	"same"             => "El :attribute y :other deben coincidir.",
	"size"             => array(
		"numeric" => "El :attribute debe ser :size.",
		"file"    => "El :attribute debe ser :size kilobytes.",
		"string"  => "El :attribute debe ser :size characters.",
		"array"   => "El :attribute must contain :size elementos.",
	),
	"unique"           => "El :attribute \":value\" ya ha sido tomado.",
	"url"              => "El formato de :attribute es invalido.",
	"recaptcha" => 'The :attribute field is not correct.',

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'catalog_id' => array(
			'exists' => 'El catalogo seleccionado no esta disponible o es invalido.',
			'required' => 'El catalogo es obligatorio',
		),
		'name' => array(
			'required' => 'El nombre es obligatorio.',
			'max' => 'El nombre puede tener como maximo :max caracteres.',
			'min' => 'El nombre debe ser almenos de :min caracteres.',
			"alpha_spaces" => "El nombre solo puede contener letras y espacios.",
			"alpha_num_spaces" => "El nombre solo puede contener letras, numeros y espacios.",
		),
		'file' => array(
			'required' => 'El archivo de imagen es obligatorio.',
			'max' => 'El tamaño maximo permitido es de 12 Megabytes.',
			//"mimes" => "El archivo de imagen debe ser de alguno de los siguientes tipos [:values].",
			"image" => "El archivo a cargar debe ser una imagen del tipo [jpeg, png, bmp].",
		),
		'tags' => array(
			'required' => 'Al menos una etiqueta debe ser especificada.',
			"alpha_spaces" => "El nombre solo puede contener letras y espacios.",
			"alpha_num_spaces" => "El nombre solo puede contener letras, numeros y espacios.",
		),
		'price' => array(
			'required' => 'El precio es requerido.',
			"numeric" => "El precio debe ser numérico",
			"alpha_num_spaces" => "El nombre solo puede contener letras, numeros y espacios.",
		),
		'type' => array(
			'required' => 'El tipo es requerido.',
			"in" => "El \"tipo\" seleccionado es invalido.",
		),
		'email' => array(
			'required' => 'El correo electrónico es obligatorio.',
			'email' => 'El formato del correo electronico no es correcto.'
		),
		'comment' => array(
			'required' => 'El comentario es obligatorio.',
		),
		'recaptcha_response_field' => array(
			'required' => 'El codigo de verificación es requerido'
		),
		'message' => array(
			'required' => 'El mensaje es obligatorio'
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
