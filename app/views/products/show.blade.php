@extends('layouts.main')

@section('head_title')
Productos
@stop

@section('content')
<!-- start: Container -->
<div class="container">

	<!-- start: Page header / Breadcrumbs -->
	<section class="breadcrumbs">
		<div class="page-header">
			<h1>{{ $product->name }}<small></small></h1>
		</div>
		<div class="breadcrumbs">
			Usted se encuentra aquí: <a href="/">Inicio</a><i class="icon-angle-right "></i>{{ HTML::link( route( 'catalogs.index' ), 'Cátalogos' ) }}<i class="icon-angle-right "></i>{{ HTML::link( route( 'catalogs.show', $product->catalog_id ), $product->catalog->name ) }}<i class="icon-angle-right "></i>{{ $product->name }}
		</div>
	</section>
	<!-- end: Page header / Breadcrumbs -->

	<div class="row">

	<!-- start: Page section -->
	<section id="page-sidebar" class="span12">

		<div class="page-inner">
			<div class="row-fluid single-portfolio">
				<div class="span8">
					@if(!$product->images->isEmpty())
						<div id="mainslider" class="flexslider">
							<ul class="slides">
									@foreach($product->images as $image)
										<li>{{ HTML::image($image->slide, $image->name, array('title' => $image->name)) }}</li>
									@endforeach
							</ul>
						</div>
					@else
						{{ HTML::image('images/no-image-slide.jpg', $product->name, array('title' => $product->name)) }}
					@endif
				</div>
				<div class="span4">
					<div class="ps-description">
						@if($product->description !== null)
							<?php //$description = str_replace('\r\n', '{&&}', $product->description) ?>
							@foreach( explode('<br />', nl2br($product->description)) as $sentence )
								<p>{{ $sentence }}</p>
							@endforeach
						@endif
						<h4>Información adicional</h4>
						<ul class="icons">
							<li><i class="icon-angle-right"></i><span>Fecha:</span> 9 Mayo, 2012</li>
							<li><i class="icon-angle-right"></i><span>Precio:</span> ${{ $product->price }}</li>
							<li><i class="icon-angle-right"></i><span>Categoria:</span> {{ $product->catalog->name }}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<hr>

		<div class="row-fluid">
			<h3>Productos relacionados</h3>
		</div>
		<div class="row-fluid">
		<!-- start: Related Projects -->
			<section class="portfolio related-projects thumbnails">

				@foreach($related_products as $related)
					<article data-id="id-{{ $related->id }}" data-type="javascript html" class="span3">
						<div class="thumbnail hover-pf1">
							@if($related->images()->first() !== null)
								<?php $image = $related->images()->first()->toArray(); ?>
								<?php $image = $image['largethumb']; ?>
							@else
								<?php $image = 'images/no-image-largethumb.jpg'; ?>
							@endif
							{{ HTML::image($image, $related->name, array('title' => $related->name)) }}
							<div class="mask-1"></div>
							<div class="mask-2"></div>
							<div class="caption">
								<h2 class="title">{{ HTML::link(route('products.show', $related->id), $related->name) }}</h2>
								<p>{{ $related->description }}</p>
								{{ HTML::link(route('products.show', $related->id), 'Ver Producto', array('class' => 'info btn btn-inverse') ) }}
							</div>
						</div>
					</article>
				@endforeach
				
			</section>
			{{-- related products pagination --}}
			{{-- $related_products->links() --}}
		<!-- end: Related Projects -->
		</div>

	</section>
	<!-- end: Page section -->

	<!-- start: Sidebar -->
	<!-- end: Sidebar -->

	</div>

</div>
<!-- end: Container -->
@stop