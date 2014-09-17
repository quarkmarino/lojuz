@extends('layouts.main')

@section('head_title')
	Galerias
@stop

@section('content')
<!-- start: Container -->
<div class="container">

	<!-- start: Page header / Breadcrumbs -->
	<section class="breadcrumbs">
		<div class="page-header">
			<h1>Galerias<small></small></h1>
		</div>
		<div class="breadcrumbs">
			Usted se encuentra aquí: <a href="/">Inicio</a><i class="icon-angle-right "></i>Galerias
		</div>
	</section>
	<!-- end: Page header / Breadcrumbs -->

	<div class="row">

		<!-- start: Page section -->
		<section id="page-sidebar" class="span12">

			<!-- start: Filter-->
			<h3>Filtrar</h3>
			<div class="row-fluid">
				<div class="span12">
					<ul id="filtrable" class="clearfix">
						<li class="current all"><a href="#all">Todos</a></li>
						@foreach($galleries as $gallery)
							@foreach(explode(', ', $gallery->tags) as $tag)
								@if( !isset($used_tags[$tag]) )
									<li class="{{ strtolower($tag) }}"><a href="#{{ strtolower($tag) }}">{{ str_replace('_', ' ', $tag) }}</a></li>
								@endif
								<?php $used_tags[$tag] = true ?>
							@endforeach
						@endforeach
					</ul>
				</div>
			</div>
		</section>
			<!-- end: Filter-->
	</div>

	<!-- start: Portfolio -->
	<section class="row filtrable portfolio thumbnails">
		@foreach($galleries as $gallery)
			<article data-id="id-{{ $gallery->id }}" data-type="{{ implode(' ', explode(', ', strtolower( $gallery->tags ) ) ) }}" class="span3">
				<div class="thumbnail hover-pf1">
					@if($gallery->images()->first() !== null)
						<?php $image = $gallery->images()->first()->largethumb; ?>
					@else
						<?php $image = 'images/no-image-largethumb.jpg'; ?>
					@endif
					{{ HTML::image($image, $gallery->name, array('title' => $gallery->name)) }}
					<div class="mask-1"></div>
					<div class="mask-2"></div>
					<div class="caption">
						<h2 class="title">{{ HTML::link(route('galleries.show', $gallery->id), $gallery->name) }}</h2>
						<p>{{ $gallery->description }}</p>
						{{ HTML::link(route('galleries.show', $gallery->id), 'Ver galeria', array('class' => 'info btn btn-inverse') ) }}
					</div>
				</div>
			</article>
		@endforeach

	</section>
	<!-- end: Portfolio -->

</div>
<!-- end: Container -->
@stop