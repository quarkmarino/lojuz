@extends('admin.products.layouts.main')

@section('title')
	<h3>Productos</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.catalogs.show', $catalog->id) }}"><i class="icon-file"></i>{{ $catalog->name }}</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-folder-open"></i>Productos</li>
@stop


@section('buttons')
	<a href="{{ route('admin.catalogs.show', $catalog->id) }}">
		<button class="btn" title="Volver al catalogo"><i class="icon-backward"></i> Volver</button>
	</a>
	<a href="{{ route('admin.catalogs.products.create', $catalog->id) }}">
		<button class="btn" title="Crear nuevo producto"><i class="icon-plus"></i> Crear</button>
	</a>
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
	<table class="table table-striped table-hover table-bordered">
		<caption>Lista de productos pertenecientes al catálogo {{ HTML::link(route('admin.catalogs.show', $catalog->id), $catalog->name) }}</caption>
		<thead>
			<tr>
				<th title="#">id</th>
				<th title="Nombre del producto">Nombre</th>
				<th title="Etiquetas del producto">Etiquetas</th>
				<th title="Visibilidad del producto">Estatus</th>
				<th title="Producto/Servicio">Tipo</th>
				<th title="Precio del producto">Precio</th>
				<th title="# de Imagenes asociadas"><i class="icon-picture"></i></th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>
						<a href="{{ route('admin.catalogs.products.show', array($catalog->id, $product->id)) }}" title="Ver Producto">{{ $product->name }}</a>
					</td>
					<td>
						{{ implode(', ', array_slice(explode(', ', $product->tags), 0, 2)).( count(explode(', ', $product->tags)) > 2 ? HTML::link(route('admin.catalogs.products.show', $product->id), ', ...') : '' )  }}
					</td>
					<td>
						<?php $values = array( 'label' => array( 'Oculta', 'Visible' ), 'emph' => array( 'text-warning', 'text-success' ) ); ?>
						<span class="{{ $values['emph'][$product->status] }}">{{ $values['label'][$product->status] }}</span>
					</td>
					<td>
						<?php $values = array( 'service' => 'Servicio', 'product' => 'Producto'); ?>
						{{ $values[$product->type] }}
					</td>
					<td>${{ $product->price }}</td>
					<td>
						@if( $product->images->count() > 0 )
							<a href="{{ route('admin.products.images.index', $product->id) }}" title="Ver Imagenes">
								{{ $product->images->count() }}
							</a>
						@else
							0
						@endif
					</td>
					<td>
						<div class="btn-group">
							<a href="{{ route('admin.catalogs.products.show', array($catalog->id, $product->id) ) }}">
								<button class="btn" title="Inspeccionar producto"><i class="icon-eye-open"></i></button>
							</a>

							<a href="{{ route('admin.catalogs.products.edit', array($catalog->id, $product->id) ) }}">
								<button class="btn" title="Modificar producto"><i class="icon-pencil"></i></button>
							</a>
							
							<a class="delete" href="{{ route('admin.catalogs.products.destroy', array($catalog->id, $product->id) ) }}" onclick="return confirm('¿Esta seguro que desea eliminar el producto \'{{ $product->name }}\' y todas sus imagenes relacionadas?')">
								<button class="btn" title="Eliminar producto"><i class="icon-trash"></i></button>
							</a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Products pagination --}}
	{{ $products->links() }}
@stop