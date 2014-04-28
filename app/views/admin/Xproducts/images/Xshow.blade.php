@extends('admin.products.layouts.images')

@section('title')
	<h3>Imagen: "{{ $image->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.products.show', $product->id) }}"><i class="icon-file"></i>{{ $product->name }}</a></li><span class="divider">/</span>
	<li><a href="{{ route('admin.products.images.index', $product->id) }}"><i class="icon-folder-open"></i>Imagenes</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-file"></i>{{ $image->name }}</li>
@stop

@section('buttons')
		<a href="{{ route('admin.products.images.create', $product->id) }}"><button class="btn" title="Crear nueva imagen"><i class="icon-plus"></i> Crear</button></a>
		<a href="{{ route('admin.products.images.index', $product->id) }}"><button class="btn" title="Listar imagenes"><i class="icon-list"></i> Listar</button></a>
		<a href="{{ route('admin.products.images.edit', array($product->id, $image->id)) }}"><button class="btn" title="Modificar este imagen"><i class="icon-pencil"></i> Editar</button></a>
		<a class="delete" href="{{ route('admin.products.images.destroy', array($product->id, $image->id)) }}" onclick="return confirm('¿Esta seguro que desea eliminar la imagen \'{{ $image->name }}\' relacionada?')"><button class="btn" title="Eliminar imagen"><i class="icon-trash"></i> Eliminar</button></a>
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
		<div class="span4">
			<h3>Detalles</h3>
			<div class="page-inner">
				<dl class="dl-horizontal">
					@foreach(array(
						'name' => array( 
							'label' => 'Nombre',
							'link' => route('admin.products.images.edit', array($product->id, $image->id)),
						),
						'product' => array( 
							'label' => 'Galería',
							'attr' => 'name',
						),
						'comment' => 'Comentario',
						'status' => array(
							'label' => 'Estatus',
							'values' => array(
								array( 'label' => 'Oculta', 'emph' => 'text-warning' ),
								array( 'label' => 'Visible', 'emph' => 'text-success' )
							)
						),
					) as $attr => $label)
							<?php $caption = is_array( $label ) ? $label['label'] : $label ?>
							<dt>{{ $caption }}:</dt>
								<dd>
								@if( is_array($label) )
									{{-- related entity attribute defined by 'attr' --}}
									@if( isset( $label['attr'] ) )
										{{ HTML::link(route('admin.products.show', array('id' => $image->$attr->id)), $image->$attr->$label['attr'], array( 'title' => 'Ver galería' ) ) }}
									@endif
									{{-- statistical query for related entity --}}
									@if( isset( $label['values'] ) )
										@if( is_array( $label['values'][$image->$attr] ) )
											<span class="{{ $label['values'][$image->$attr]['emph'] }}">{{ $label['values'][$image->$attr]['label'] }}</span>
										@else
											{{ $label['values'][$image->$attr] }}
										@endif
									@endif
									{{-- link definition for attribute --}}
									@if( isset( $label['link'] ) )
										{{ HTML::link($label['link'], $image->$attr) }}
									@endif
									{{-- attribute prefix definition  --}}
								@else
									{{ $image->$attr }}
								@endif
							</dd>
					@endforeach
				</dl>
			</div>
		</div>
		<div class="span8">
			<div class="row-fluid">
				<div class="span7">
					<h3>Tamaños</h3>
				</div>
				<div class="span5">
					<div class="btn-toolbar clearfix">
						<div class="btn-group pull-right">
							<a href="{{ route('admin.products.images.edit', array($product->id, $image->id)) }}"><button class="btn" title="Modificar detalles y tamaños de esta imagen"><i class="icon-plus"></i> Cambiar imagenes</button></a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner">
				<section class="row-fluid portfolio thumbnails">
					<?php $span = 0; ?>
					@foreach(array('slide' => array( 'title' => 'Slide', 'span' => 12 ), 'largethumb' => array( 'title' => 'Miniatura G', 'span' => 4 ), 'thumb' => array( 'title' => 'Miniatura M', 'span' => 4 ), 'minithumb' => array( 'title' => 'Miniatura C', 'span' => 4 ), ) as $picture => $label)
						<article data-id="id-{{ $image->id }}" data-type="javascript html" class="span{{ $label['span'] }}">
							<?php $span += $label['span']; ?>
							<div class="thumbnail hover-pf1">
								{{ HTML::image($image->$picture, $image->label, array('class' => 'img-rounded')); }}
								{{--<img src="example/latest1.jpg" alt="">--}}
								<div class="mask-1"></div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2><a class="title" href="{{ route('admin.products.images.show', array($product->id, $image->id)) }}", title="Ver imagen" target="_black"><i class="icon-eye-open"></i> Ver {{ $label['title'] }}</a></h2>
								</div>
							</div>
						</article>
						@if($span % 12 == 0 && $span > 0)
							<?php $span = 0; ?>
				</section>
				<section class="row-fluid portfolio thumbnails">
						@endif
					@endforeach
				</section>
			</div>
		</div>
	</div>
@stop