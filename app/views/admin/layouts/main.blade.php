<!DOCTYPE html>
<html>
	<head>
		<title>Lojuz - @yield('head_title')</title>
		<meta http-equiv="Content-Type" content="text/html, charset=utf-8"/>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
		<link rel="shortcut icon" href="images/favicon.ico"/>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png"/>
		<link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png"/>

		@section('css')
			@include('partials.css')
			{{--<link href="//www.fuelcdn.com/fuelux/2.6.0/css/fuelux.min.css" rel="stylesheet" type="text/css">
			<link href="//www.fuelcdn.com/fuelux/2.6.0/css/fuelux-responsive.css" rel="stylesheet" type="text/css">--}}
		@show

		@section('javascript')
			@include('partials.javascript')
			{{--<script src="http://www.fuelcdn.com/fuelux/2.6.0/loader.min.js" type="text/javascript"></script>--}}
		@show

	</head>
	
	<body>
		@section('nav')
			<?php
				$nav['brand'] = array('logo' => '/img/logo.png');
				$nav['items'] = array( 'home' => array('label' => 'Inicio', 'url' => '//'), 'admin' => array('label' => 'Administracion', 'url' => 'admin/home'), 'about' => 'Información', 'catalog' => 'Catálogo', 'galleries' => 'Galerías', 'contact' => 'Contacto', 'logout' => 'Salir' );
			?>
			@include( 'widgets.navbar', $nav )
		@show

		<div class="container">
			@section('breadcrumbs')
				<!-- start: Page header / Breadcrumbs -->
				<section class="breadcrumbs">
					<div class="page-header">
						<h2>Administración<small></small></h2>
					</div>
					<ul class="breadcrumb">
						@section('breadcrumbs')
							<li><a href="#">Inicio</a> <span class="divider">/</span></li>
						@show
					</ul>
				</section>
				<!-- end: Page header / Breadcrumbs -->

			<div class="row">
					<section id="page-sidebar" class="span12">
						<div class="row">
							<div class="span3 bs-docs-sidebar">
								<ul class="nav nav-list bs-docs-sidenav affix">
									<li><a href="/dashboard"><i class="icon-chevron-right"></i> Administración</a></li>
									<li><a href="/news"><i class="icon-chevron-right"></i> Noticias</a></li>
									<li><a href="/clients"><i class="icon-chevron-right"></i> Clientes</a></li>
									<li><a href="/catalogs"><i class="icon-chevron-right"></i> Catalogos</a></li>
									<li class="active"><a href="/products"><i class="icon-chevron-right"></i> Productos</a></li>
									<li><a href="/galleries"><i class="icon-chevron-right"></i> Galerias</a></li>
									<li><a href="/images"><i class="icon-chevron-right"></i> Imagenes</a></li>
									<li><a href="/users"><i class="icon-chevron-right"></i> Usuarios</a></li>
								</ul>
							</div>
							<div class="span9">
								@yield('content')
							</div>
						</div>
					</section>
			</div>
		</div>

		@section('footer')
			@include('partials.footer')
			@include('partials.footer-menu')
		@show
	</body>
</html>