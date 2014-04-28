@extends('admin.images.layouts.main')

@section('title')
	<h3>Imagenes</h3>
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><i class="icon-folder-open"></i>Imagenes</li>
@stop


@section('buttons')
	<a href="{{ route('admin.products.lists') }}"><button class="btn" title="Volver a los productos"><i class="icon-backward"></i> Volver</button></a>
@stop

@section('content')
	@parent
	<table class="table table-striped table-hover table-bordered">
		<caption>Lista de imagenes</caption>
		<thead>
			<tr>
				@foreach(array('id' => '#', 'name' => 'Nombre', 'product' => 'Producto', 'status' => 'Estatus') as $key => $attribute)
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
						'name' => array( 'label' => 'Nombre', 'link' => route('admin.images.show', array($image->id, $image->id)) ),
						'image' => array( 'label' => 'Galería', 'attr' => 'name' ),
						'status' => array( 'values' => array( array( 'label' => 'Oculta', 'emph' => 'text-warning' ), array( 'label' => 'Visible', 'emph' => 'text-success' )) ),
						) as $key => $label)
							<td>
								@if( is_array($label) )
									@if( isset( $label['attr'] ) )
										@if( !empty( $image->$key->$label['attr'] ) )
											@if($image->product_id !== null)
												{{ HTML::link(route('admin.catalogs.images.show', array($image->product_id, $image->id)), $image->$key->$label['attr'], array( 'title' => 'Ver producto' ) ) }}
											@else
												{{ HTML::link(route('admin.images.show', $image->$key->id), $image->$key->$label['attr'], array( 'title' => 'Ver producto' ) ) }}
											@endif
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
							{{--<a href="{{ route('admin.images.show', array($image->id, $image->id) ) }}"><button class="btn" title="Inspeccionar imagen"><i class="icon-eye-open"></i></button></a>--}}
							<a href="{{ route('admin.images.edit', $image->id ) }}"><button class="btn" title="Modificar imagen"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="{{ route('admin.images.destroy', $image->id) }}" onclick="return confirm('¿Esta seguro que desea eliminar la imagen \'{{ $image->name }}\' relacionada?')"><button class="btn" title="Eliminar imagen"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Products pagination --}}
	{{-- $images->links() --}}
@stop