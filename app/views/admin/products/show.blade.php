@extends('admin.products.layouts.main')

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
		<a href="{{ route('admin.catalogs.products.create', $catalog->id) }}">
			<button class="btn" title="Crear nuevo producto"><i class="icon-plus"></i> Crear</button>
		</a>
		<a href="{{ route('admin.catalogs.products.index', $catalog->id) }}">
			<button class="btn" title="Listar productos"><i class="icon-list"></i> Listar</button>
		</a>
		<a href="{{ route('admin.catalogs.products.edit', array($catalog->id, $product->id)) }}">
			<button class="btn" title="Modificar este producto"><i class="icon-pencil"></i> Editar</button>
		</a>
		<a class="delete" href="{{ route('admin.catalogs.products.destroy', array($catalog->id, $product->id)) }}" onclick="return confirm('¿Esta seguro que desea eliminar el producto \'{{ $product->name }}\' y todas sus imagenes relacionadas?')">
			<button class="btn" title="Eliminar producto"><i class="icon-trash"></i> Eliminar</button>
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
	<div class="row-fluid">
		<div class="span6">
			<h3>Detalles</h3>
			<div class="page-inner">
				<dl class="dl-horizontal">
					@foreach(array(
						'name' => array( 
							'label' => 'Nombre',
							'link' => route('admin.catalogs.products.edit', array($catalog->id, $product->id)),
						),
						'catalog' => array( 
							'label' => 'Catalogo',
							'attr' => 'name',
						),
						//'description' => 'Descripción',
						'tags' => 'Etiquetas',
						'status' => array(
							'label' => 'Estatus',
							'values' => array(
								array( 'label' => 'Oculta', 'emph' => 'text-warning' ),
								array( 'label' => 'Visible', 'emph' => 'text-success' )
							)
						),
						'type' => array(
							'label' => 'Tipo',
							'values' => array(
								'service' => 'Servicio',
								'product' => 'Producto'
							)
						),
						'price' => array( 'label' => 'Precio', 'prefix' => '$'),
						'images' => array( 'label' => 'Imagenes', 'stat' => 'count')
					) as $attr => $label)
							<?php $caption = is_array( $label ) ? $label['label'] : $label ?>
							<dt>{{ $caption }}:</dt>
								<dd>
								@if( is_array($label) )
									{{-- related entity attribute defined by 'attr' --}}
									@if( isset( $label['attr'] ) )
										{{-- @if( !empty( $product->$attr->$label['attr'] ) ) --}}
											{{ HTML::link(route('admin.catalogs.show', array('id' => $product->$attr->id)), $product->$attr->$label['attr'], array( 'title' => 'Ver catalogo' ) ) }}
										{{--@else
											{{ HTML::link(route('admin.products.edit', array('id' => $product->id)), 'Asignar catalogo' ) }}
										@endif--}}
									@endif
									{{-- statistical query for related entity --}}
									@if( isset( $label['stat'] ) )
										@if( $product->$attr->$label['stat']() > 0 )
											{{ $product->$attr->$label['stat']() }}
										@else
											{{ 'Ninguna' }}
										@endif
									@endif
									{{-- multiple attribute value traduction definition --}}
									@if( isset( $label['values'] ) )
										@if( is_array( $label['values'][$product->$attr] ) )
											<span class="{{ $label['values'][$product->$attr]['emph'] }}">{{ $label['values'][$product->$attr]['label'] }}</span>
										@else
											{{ $label['values'][$product->$attr] }}
										@endif
									@endif
									{{-- link definition for attribute --}}
									@if( isset( $label['link'] ) )
										{{ HTML::link($label['link'], $product->$attr) }}
									@endif
									{{-- attribute prefix definition  --}}
									@if( isset( $label['prefix'] ) )
										{{ $label['prefix'].$product->$attr }}
									@endif

								@else
									{{ $product->$attr }}
								@endif
							</dd>
					@endforeach
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