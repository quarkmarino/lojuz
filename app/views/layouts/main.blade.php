<!DOCTYPE html>
<html>
	<head>
		<title>Lojuz - @yield('head_title')</title>
		<meta http-equiv="Content-Type" content="text/html, charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
    <link rel="icon" href="images/favicon.ico" type="image/icon"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png"/>

		@section('css')
			@include('assets.css')
		@show

		@section('javascript')
			@include('assets.javascript')
		@show

	</head>
	
	<body>
		@section('nav')
			<?php $catalogs = \Models\Catalog::whereStatus(1)->limit(8)->get()->lists('name', 'id'); ?>

			<?php
				$nav['brand'] = array('logo' => '/images/logo.png');
				$nav['items'] = array( 'home' => array('label' => 'Inicio', 'url' => ''), 'about' => 'Información', 'catalogs' => array( 'label' => 'Catálogos', 'items' => $catalogs), 'galleries' => 'Galerías', 'contact' => 'Contacto' );
			?>
			@include( 'widgets.navbar', $nav )
		@show

		@yield('content')

		@section('footer')
			@include('partials.footer')
			@include('partials.footer-menu')
		@show
	</body>
</html>