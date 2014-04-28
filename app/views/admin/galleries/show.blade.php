@extends('admin.galleries.layouts.main')

@section('title')
	<h3>Galería: "{{ $gallery->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.galleries.index') }}"><i class="icon-folder-open"></i>Galerias</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-file"></i>{{ $gallery->name }}</li>
@stop

@section('buttons')
	<a href="{{ route('admin.galleries.create') }}"><button class="btn" title="Crear nueva galería"><i class="icon-plus"></i> Crear</button></a>
	<a href="{{ route('admin.galleries.index') }}"><button class="btn" title="Listar galerias"><i class="icon-list"></i> Listar</button></a>
	<a href="{{ route('admin.galleries.edit', $gallery->id) }}"><button class="btn" title="Modificar este galería"><i class="icon-pencil"></i> Editar</button></a>
	<a class="delete" href="{{ route('admin.galleries.destroy', $gallery->id) }}" onclick="return confirm('¿Esta seguro que desea eliminar el galería \'{{ $gallery->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar galería"><i class="icon-trash"></i> Eliminar</button></a>
@stop

@section('content')
	@parent
	<div class="row-fluid">
		<div class="span6">
			<h3>Detalles</h3>
			<div class="page-inner">
				<dl class="dl-horizontal">
					@foreach(array(
						'name' => array( 
							'label' => 'Nombre',
							'link' => route('admin.galleries.edit', array('id' => $gallery->id)),
						),
						'description' => 'Descripción',
						'tags' => 'Etiquetas',
						'status' => array(
							'label' => 'Estatus',
							'values' => array(
								array( 'label' => 'Oculta', 'emph' => 'text-warning' ),
								array( 'label' => 'Visible', 'emph' => 'text-success' )
							)
						),
						'images' => array( 'label' => 'Imagenes', 'stat' => 'count')
					) as $attr => $label)
							<?php $caption = is_array( $label ) ? $label['label'] : $label ?>
							<dt>{{ $caption }}:</dt>
								<dd>
								@if( is_array($label) )
									{{-- statistical query for related entity --}}
									@if( isset( $label['stat'] ) )
										@if( $gallery->$attr->$label['stat']() > 0 )
											{{ HTML::link(route('admin.galleries.images.index', $gallery->id), $gallery->$attr->$label['stat'](), array('title' => 'Listar imagenes') )}}
										@else
											{{ 'Ninguna' }}
										@endif
									@endif
									{{-- multiple attribute value traduction definition --}}
									@if( isset( $label['values'] ) )
										@if( is_array( $label['values'][$gallery->$attr] ) )
											<span class="{{ $label['values'][$gallery->$attr]['emph'] }}">{{ $label['values'][$gallery->$attr]['label'] }}</span>
										@else
											{{ $label['values'][$gallery->$attr] }}
										@endif
									@endif
									{{-- link definition for attribute --}}
									@if( isset( $label['link'] ) )
										{{ HTML::link($label['link'], $gallery->$attr) }}
									@endif
									{{-- attribute prefix definition  --}}
									{{--@if( isset( $label['prefix'] ) )
										{{ $label['prefix'].$gallery->$attr }}
									@endif--}}

								@else
									{{ $gallery->$attr }}
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
							<a href="{{ route('admin.galleries.edit', $gallery->id) }}"><button class="btn" title="Crear y agregar una nueva imagen a esta galería"><i class="icon-plus"></i> Agregar</button></a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner">
				<section class="row-fluid portfolio thumbnails">
					<?php $i = 0; ?>
					@foreach($gallery->images as $image)
						<article data-id="id-{{ $image->id }}" data-type="javascript html" class="span4">
							<div class="thumbnail hover-pf1">
								{{ HTML::image($image->thumb, $image->name, array('class' => 'img-rounded')); }}
								{{--<img src="example/latest1.jpg" alt="">--}}
								<div class="mask-1"></div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2><a class="title" href="{{ route('admin.galleries.images.show', array($gallery->id, $image->id)) }}", title="Ver imagen"><i class="icon-eye-open"></i> Ver</a></h2>
								</div>
							</div>
						</article>
						@if(++$i % 3 == 0 && $i > 0)
				</section>
				<section class="row-fluid portfolio thumbnails">
						@endif
					@endforeach
				</section>
			</div>
		</div>
	</div>
@stop