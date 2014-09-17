ss@extends('admin.products.layouts.main')

@section('title')
	<h3>Producto: "{{ $product->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.catalogs.show', $catalog->id) }}"><i class="icon-file"></i>{{ $catalog->name }}</a></li><span class="divider">/</span>
	<li><a href="{{ route('admin.catalogs.products.index', $catalog->id) }}"><i class="icon-folder-open"></i>Productos</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-file"></i>{{ $product->name }}</li>
@stop

@section('buttons')
		{{--<a href="{{ route('admin.catalogs.products.create', $catalog->id) }}">
			<button class="btn" title="Crear nuevo producto"><i class="icon-plus"></i> Crear</button>
		</a>
		<a href="{{ route('admin.catalogs.products.index', $catalog->id) }}">
			<button class="btn" title="Listar productos"><i class="icon-list"></i> Listar</button>
		</a>--}}
		<a href="{{ route('admin.catalogs.products.index', $catalog->id) }}">
			<button class="btn" title="Volver a productos"><i class="icon-backward"></i> Volver</button>
		</a>
		<a href="{{ route('admin.catalogs.products.edit', array($catalog->id, $product->id)) }}">
			<button class="btn" title="Modificar este producto"><i class="icon-pencil"></i> Editar</button>
		</a>
		{{--<a class="delete" href="{{ route('admin.catalogs.products.destroy', array($catalog->id, $product->id)) }}" onclick="return confirm('¿Esta seguro que desea eliminar el producto \'{{ $product->name }}\' y todas sus imagenes relacionadas?')">
			<button class="btn" title="Eliminar producto"><i class="icon-trash"></i> Eliminar</button>
		</a>--}}
@stop

@section('content')
	@parent
	<div class="row-fluid">
		<div class="span12">
			<div class="alert-box text-success">
				@if(Session::has('success'))
					<h3>{{ Session::get('success') }}</h3>
				@endif
			</div>
			<div class="alert-box text-error">
				@if(Session::has('error'))
					<h3>{{ Session::get('error') }}</h3>
				@endif
			</div>
			<ul class="errors">
				@foreach($errors->all() as $message)
				<li>{{ $message }}</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<h3>Detalles</h3>
			<div class="page-inner">
				<dl class="dl-horizontal">
					<dt>Nombre:</dt>
						<dd>
							{{ HTML::link( route('admin.catalogs.products.edit', array($catalog->id, $product->id)), $product->name) }}
						</dd>
					<dt>Catálogo:</dt>
						<dd>
							{{ HTML::link(route('admin.catalogs.show', array('id' => $product->catalog->id)), $product->catalog->name, array( 'title' => 'Ver catalogo' ) ) }}
						</dd>
					<dt>Etiquetas:</dt>
						<dd>
							{{ $product->tags }}
						</dd>
					<dt>Estatus:</dt>
						<dd>
							<?php $values = array('label' => array('Oculta', 'Visible'), 'emph' => array('text-warning', 'text-success')); ?>
							<span class="{{ $values['emph'][$product->status] }}">{{ $values['label'][$product->status] }}</span>
						</dd>
					<dt>Tipo:</dt>
						<dd>
							<?php $values = array('service' => 'Servicio','product' => 'Producto'); ?>
							{{ $values[$product->type] }}
						</dd>
					<dt>Precio:</dt>
						<dd>
							${{ $product->price }}
						</dd>
					<dt>Imagenes:</dt>
						<dd>
							@if( $product->images->count() > 0 )
								{{ $product->images->count() }}
							@else
								{{ 'Ninguna' }}
							@endif
						</dd>
				</dl>
			</div>
		</div>
		<div class="span6">
			<div class="row-fluid">
				<div class="span7">
					<h3>Imagenes</h3>
				</div>
				<div class="span5">
					<div class="btn-toolbar clearfix">
						<div class="btn-group pull-right">
							<a href="{{ route('admin.catalogs.products.edit', array($catalog->id, $product->id)) }}">
								<button class="btn" title="Crear y agregar un nuevo producto a este catalogo"><i class="icon-plus"></i> Agregar</button>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner">
				<section class="row-fluid portfolio thumbnails">
					<?php $i = 0; ?>
					@foreach($product->images as $image)
						<article data-id="id-{{ $image->id }}" data-type="javascript html" class="span6">
							<div class="thumbnail hover-pf1">
								{{ HTML::image($image->largethumb, $image->name, array('class' => 'img-rounded')); }}
								{{--<img src="example/latest1.jpg" alt="">--}}
								<div class="mask-1"></div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2><a class="title" href="{{ route('admin.products.images.edit', array($product->id, $image->id)) }}", title="Editar"><i class="icon-pencil"></i> {{ $image->name }}</a></h2>
								</div>
							</div>
						</article>
						@if(++$i % 2 == 0 && $i > 0)
				</section>
				<section class="row-fluid portfolio thumbnails">
						@endif
					@endforeach
				</section>
			</div>
		</div>
	</div>
@stop