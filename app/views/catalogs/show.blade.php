@extends('layouts.main')

@section('head_title')
	{{ $catalog->name }}
@stop

@section('nav')
	<?php $nav['options'] = array('active_item' => 'catalogs'); ?>
	@parent
@stop

@section('content')
<!-- start: Container -->
	<div class="container">

		<!-- start: Page header / Breadcrumbs -->
		<section class="breadcrumbs">
			<div class="page-header">
				<h1>{{ $catalog->name }}<small>/ cátalogo</small></h1>
			</div>
			<div class="breadcrumbs">
				Usted se encuentra aquí: <a href="/">Inicio</a><i class="icon-angle-right "></i>{{ HTML::link( route( 'catalogs.index' ), 'Cátalogos' ) }}<i class="icon-angle-right "></i>{{ $catalog->name }}
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
							@foreach($catalog->products as $product)
								@foreach(explode(', ', $product->tags) as $tag)
									@if( !isset($tags[$tag]) )
										<li class="{{ strtolower($tag) }}"><a href="#{{ strtolower($tag) }}">{{ $tag }}</a></li>
									@endif
									<?php $tags[$tag] = true ?>
								@endforeach
							@endforeach
						</ul>
					</div>
				</div>
				<!-- end: Filter-->
			</section>
			<!-- end: Page section -->

		</div>

		<!-- start: Portfolio -->
		<section class="row filtrable portfolio thumbnails">

			@foreach($catalog->products as $product)
				<article data-id="id-{{ $product->id }}" data-type="{{ implode(' ', explode(', ', strtolower( $product->tags ) ) ) }}" class="span3">
					<div class="thumbnail hover-pf1">
						@if($product->images()->first() !== null)
							<?php $image = $product->images()->first()->toArray(); ?>
							<?php $image = $image['largethumb']; ?>
						@else
							<?php $image = 'images/no-image-largethumb.jpg'; ?>
						@endif
						{{ HTML::image($image, $product->name, array('title' => $product->name)) }}
						<div class="mask-1"></div>
						<div class="mask-2"></div>
						<div class="caption">
							<h2 class="title">{{ HTML::link(route('products.show', $product->id), $product->name) }}</h2>
							<p>{{ $product->description }}</p>
							<?php $type = array( 'product' => 'Producto', 'service' => 'Servicio'); ?>
							{{ HTML::link(route('products.show', $product->id), 'Ver '.$type[$product->type], array('class' => 'info btn btn-inverse') ) }}
						</div>
					</div>
				</article>
			@endforeach

		</section>
		<!-- end: Portfolio -->

	</div>
	<!-- end: Container -->
@stop