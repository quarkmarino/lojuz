@extends('admin.galleries.layouts.main')

@section('title')
	<h3>Galerias</h3>
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><i class="icon-folder-open"></i>Galerias</li>
@stop

@section('buttons')
	<a href="{{ route('admin.galleries.create') }}"><button class="btn" title="Crear nueva galeria"><i class="icon-plus"></i> Crear</button></a>
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
			<caption>Lista de productos asignados</caption>
			<thead>
				<tr>
					@foreach(array('id' => '#', 'name' => 'Nombre', 'description' => 'Descripción', 'tags' =>'Etiquetas', 'status' => 'Estatus', 'images' => array( 'icon' => 'picture', 'label' => '# de Imagenes' )) as $key => $attribute)
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
			@foreach($galleries as $gallery)
				<tr>
					@foreach(array(
						'id' => '#',
						'name' => array( 'label' => 'Nombre', 'link' => route('admin.galleries.show', $gallery->id) ),
						'description' => 'Descripción',
						'tags' => array( 'label' => 'Etiquetas', 'pick' => 3 ),
						'status' => array( 'values' => array( array( 'label' => 'Oculta', 'emph' => 'text-warning' ), array( 'label' => 'Visible', 'emph' => 'text-success' )) ),
						'images' => array( 'label' => 'Imagenes', 'stat' => 'count', 'link' => route('admin.galleries.images.index', $gallery->id))
						) as $key => $label)
							<td>
								@if( is_array($label) )

									@if( isset( $label['values'] ) )
										@if( is_array( $label['values'][$gallery->$key] ) )
											<span class="{{ $label['values'][$gallery->$key]['emph'] }}">{{ $label['values'][$gallery->$key]['label'] }}</span>
										@else
											{{ $label['values'][$gallery->$key] }}
										@endif
									@endif

									@if( isset( $label['link'] ) )
										<a href="{{ $label['link'] }}" @if( isset($label['title']) )title="{{ $label['title'] }}" @endif>
											@if( isset($label['stat']) )
												{{ $gallery->$key->$label['stat']() }}
											@else
												{{ $gallery->$key }}
											@endif
										</a>
									@endif

									@if( isset( $label['pick'] ) )
										{{ implode(', ', array_slice(explode(', ', $gallery->$key), 0, $label['pick'])).( count(explode(', ', $gallery->$key)) > $label['pick'] ? HTML::link(route('admin.galleries.show', $gallery->id), ', ...') : '' )  }}
									@endif
								@else
										{{ $gallery->$key }}
								@endif
							</td>
					@endforeach
					<td>
						<div class="btn-group">
							<a href="{{ route('admin.galleries.show', $gallery->id ) }}"><button class="btn" title="Inspeccionar galeria"><i class="icon-eye-open"></i></button></a>
							<a href="{{ route('admin.galleries.edit', $gallery->id ) }}"><button class="btn" title="Modificar galeria"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="{{ route('admin.galleries.destroy', $gallery->id ) }}" onclick="return confirm('¿Esta seguro que desea eliminar el galeria \'{{ $gallery->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar galeria"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Products pagination --}}
	{{ $galleries->links() }}
@stop