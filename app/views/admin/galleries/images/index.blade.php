@extends('admin.galleries.layouts.images')

@section('title')
	<h3>Productos</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.galleries.show', $gallery->id) }}"><i class="icon-file"></i>{{ $gallery->name }}</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-folder-open"></i>Productos</li>
@stop


@section('buttons')
	<a href="{{ route('admin.galleries.show', $gallery->id) }}"><button class="btn" title="Volver al galería"><i class="icon-backward"></i> Volver</button></a>
	<a href="{{ route('admin.galleries.images.create', $gallery->id) }}"><button class="btn" title="Crear nueva imagen"><i class="icon-plus"></i> Crear</button></a>
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
		<caption>Lista de imagenes asignadas actualmente asignadas a la galería {{ HTML::link(route('admin.galleries.show', $gallery->id), $gallery->name) }}</caption>
		<thead>
			<tr>
				@foreach(array('id' => '#', 'name' => 'Nombre', 'gallery' => 'Galería', 'status' => 'Estatus') as $key => $attribute)
					@if(is_array( $attribute ))
						<th title="{{ $attribute['label'] }}"><i class="icon-{{ $attribute['icon'] }}"></i></th>
					@else
						<th>{{ $attribute }}</th>
					@endif
				@endforeach
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($images as $image)
				<tr>
					@foreach(array(
						'id' => '#',
						'name' => array( 'label' => 'Nombre', 'link' => route('admin.galleries.images.show', array($gallery->id, $image->id)) ),
						'gallery' => array( 'label' => 'Galería', 'attr' => 'name' ),
						'status' => array( 'values' => array( array( 'label' => 'Oculta', 'emph' => 'text-warning' ), array( 'label' => 'Visible', 'emph' => 'text-success' )) ),
						) as $key => $label)
							<td>
								@if( is_array($label) )
									@if( isset( $label['attr'] ) )
										@if( !empty( $image->$key->$label['attr'] ) )
											{{ HTML::link(route('admin.galleries.show', $image->$key->id), $image->$key->$label['attr'], array( 'title' => 'Ver galería' ) ) }}
										@endif
									@endif

									@if( isset( $label['values'] ) )
										@if( is_array( $label['values'][$image->$key] ) )
											<span class="{{ $label['values'][$image->$key]['emph'] }}">{{ $label['values'][$image->$key]['label'] }}</span>
										@else
											{{ $label['values'][$image->$key] }}
										@endif
									@endif

									@if( isset( $label['link'] ) )
										{{ HTML::link($label['link'], $image->$key) }}
									@endif

								@else
										{{ $image->$key }}
								@endif
							</td>
					@endforeach
					<td>
						<div class="btn-group">
							<a href="{{ route('admin.galleries.images.show', array($gallery->id, $image->id) ) }}"><button class="btn" title="Inspeccionar imagen"><i class="icon-eye-open"></i></button></a>
							<a href="{{ route('admin.galleries.images.edit', array($gallery->id, $image->id) ) }}"><button class="btn" title="Modificar imagen"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="{{ route('admin.galleries.images.destroy', array($gallery->id, $image->id) ) }}" onclick="return confirm('¿Esta seguro que desea eliminar la imagen \'{{ $image->name }}\' relacionada?')"><button class="btn" title="Eliminar imagen"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Products pagination --}}
	{{ $images->links() }}
@stop