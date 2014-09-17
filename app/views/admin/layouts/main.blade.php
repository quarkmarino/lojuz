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
			@include('assets.css')
			<link rel="stylesheet" type="text/css" href="/css/bs-preview.css"/>
			{{--<link href="//www.fuelcdn.com/fuelux/2.6.0/css/fuelux.min.css" rel="stylesheet" type="text/css">
			<link href="//www.fuelcdn.com/fuelux/2.6.0/css/fuelux-responsive.css" rel="stylesheet" type="text/css">--}}
		@show

		@section('javascript')
			@include('assets.javascript')
			{{--<script src="http://www.fuelcdn.com/fuelux/2.6.0/loader.min.js" type="text/javascript"></script>--}}
		@show

	</head>
	
	<body>
		@section('nav')
			<?php $catalogs = \Models\Catalog::whereStatus(1)->limit(8)->get()->lists('name', 'id'); ?>

			<?php
				$nav['brand'] = array('logo' => '/img/logo.png');
				$nav['items'] = array( 'home' => array('label' => 'Inicio', 'url' => ''), 'admin' => array('label' => 'Administracion', 'url' => 'admin/home'), 'about' => 'Información', 'catalogs' => array( 'label' => 'Catálogos', 'items' => $catalogs), 'galleries' => 'Galerías', 'contact' => 'Contacto', 'signout' => 'Salir' );
			?>
			@include( 'widgets.navbar', $nav )
		@show

		<div class="container">
			<!-- start: Page header / Breadcrumbs -->
			<section class="breadcrumbs">
				<div class="page-header">
					<h2>Administración<small></small></h2>
				</div>
				<ul class="breadcrumb">
					@section('breadcrumbs')
						<li><a href="/"><i class="icon-home"></i>Lojuz</a></li>
						<span class="divider">/</span>
						<li><a href="{{ route('admin.home') }}"><i class="icon-wrench"></i>Administración</a></li><span class="divider">/</span>
					@show
					<li class="pull-right"><i class="icon-user"></i><strong>{{ ucfirst( Auth::user()->username ) }}</strong></li>
				</ul>
			</section>
			<!-- end: Page header / Breadcrumbs -->
			<div class="row">
				<section id="page-sidebar" class="span12">
					<div class="row">
						<div class="span3 bs-docs-sidebar">
							<ul class="nav nav-list bs-docs-sidenav">
								<li class="nav-header">Inicio</li>

								<li @if( Request::is('admin/dashboard') ) class="active" @endif><a href="{{ route('admin.home') }}"><i class="icon-wrench"></i><i class="icon-chevron-right"></i> Panel</a></li>

								<li @if( Request::is('admin/news*') ) class="active" @endif><a href="{{ route('admin.news.index') }}"><i class="icon-bullhorn"></i><i class="icon-chevron-right"></i> Noticias</a></li>

								<li @if( Request::is('admin/clients*') ) class="active" @endif><a href="{{ route('admin.clients.index') }}"><i class="icon-bookmark"></i><i class="icon-chevron-right"></i> Clientes</a></li>

								{{--<li @if( Request::is('admin/users') || Request::is('admin/users/*') ) class="active" @endif><a href="{{ route('admin.users.index') }}"><i class="icon-user"></i><i class="icon-chevron-right"></i> Usuarios</a></li>--}}

								<li class="nav-header">Catálogos</li>

								<li @if( Request::is('admin/catalogs*') && !Request::is('admin/catalogs/*/products*') ) class="active" @endif><a href="{{ route('admin.catalogs.index') }}"><i class="icon-briefcase"></i><i class="icon-chevron-right"></i> Catálogos</a></li>

								<li @if( ( Request::is('admin/products*') || Request::is('admin/catalogs/*/products*') ) && !Request::is('*images*') ) class="active" @endif><a href="{{ route('admin.products.lists') }}"><i class="icon-list-alt"></i><i class="icon-chevron-right"></i> Productos</a></li>

								<li @if( Request::is('admin/products/*/images*') || Request::is('admin/products/images*') ) class="active" @endif><a href="{{ route('admin.products.images.lists') }}"><i class="icon-picture"></i><i class="icon-chevron-right"></i> Imagenes</a></li>

								<li class="nav-header">Galerias</li>

								<li @if( Request::is('admin/galleries*') && !Request::is('*/images*') ) class="active" @endif><a href="{{ route('admin.galleries.index') }}"><i class="icon-th-large"></i><i class="icon-chevron-right"></i> Galerias</a></li>

								<li @if( Request::is('admin/galleries/*/images*') || Request::is('admin/galleries/images*') ) class="active" @endif><a href="{{ route('admin.galleries.images.lists') }}"><i class="icon-picture"></i><i class="icon-chevron-right"></i> Imagenes</a></li>
								
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