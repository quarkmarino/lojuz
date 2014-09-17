@extends('layouts.main')

@section('head_title')
	Noticias
@stop

@section('nav')
	@parent
@stop

{{--@section('javascript')
	@parent
	<script type="text/javascript" src="js/layerslider.kreaturamedia.jquery.js"></script>
@stop

@section('css')
	@parent
	<link rel="stylesheet" type="text/css" href="css/layerslider.css" >
@stop--}}



@section('content')

<div class="container">

	<!-- start: Page header / Breadcrumbs -->
	<section class="breadcrumbs">
		<div class="page-header">
			<h1>Noticias<small></small></h1>
		</div>
		<div class="breadcrumbs">
			Usted se encuentra aquí: <a href="/">Inicio</a><i class="icon-angle-right "></i>Noticias
		</div>
	</section>
	<!-- end: Page header / Breadcrumbs -->

	<div class="row">
		<!-- start: Page section -->
		<section id="page-sidebar" class="span12">
			<div class="page-inner">
			@foreach($news as $news_item)
				<div class="row-fluid">
					<section class="welcome pull-center">
					<h1>
						{{ $news_item->title }}
					</h1>
					<h4>
						{{ $news_item->message }}
					</h4>
					<p>
						@if(!empty( $news_item->product_id ))
							{{ HTML::link(route('products.show', $news_item->product_id), 'Ir al producto', array('class' => 'btn btn-primary' )) }}
						@endif
					</p>
					</section>
				</div>
				<hr>
			@endforeach
			</div>
		</section>
	</div>
</div>
@stop