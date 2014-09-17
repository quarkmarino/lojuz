<?php $owner_class = strtolower($owner); ?>
<?php $owner_class_plural = str_plural($owner_class); ?>

@extends("admin.$owner_class_plural.layouts.image")

@section('title')
	<h3>Imagenes</h3>
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><i class="icon-folder-open"></i>Imagenes</li>
@stop

<?php $owner_plural = str_plural($owner); ?>

@section('buttons')
	<a href="{{ route("admin.$owner_plural.lists") }}"><button class="btn" title="Volver a l@s {{ Lang::choice('messages.'.$owner, 2) }}"><i class="icon-backward"></i> Volver</button></a>
@stop


@section('content')
	@parent
	<table class="table table-striped table-hover table-bordered">
		<caption>Lista de imagenes de {{ HTML::link(route("admin.$owner_plural.lists"), Lang::choice('messages.'.$owner, 2) ) }}
		</caption>
		<thead>
			<tr>
				{{--dd(Lang::getLocale(), Lang::has('gallery', 'es'))--}}
				@foreach(array('id' => '#', 'name' => 'Nombre', $owner => ucfirst( Lang::choice('messages.'.$owner, 1) ), 'status' => 'Estatus') as $key => $attribute)
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
						'name' => array( 'label' => 'Nombre', 'link' => $owner ),
						$owner => array( 'label' => Lang::choice('messages.'.$owner, 1), 'attr' => 'name' ),
						'status' => array( 'values' => array( array( 'label' => 'Oculta', 'emph' => 'text-warning' ), array( 'label' => 'Visible', 'emph' => 'text-success' )) ),
						) as $key => $label)
							<td>
								@if( is_array($label) )
									@if( isset( $label['attr'] ) )
										@if( !empty( $image->$key->$label['attr'] ) )
											@if($owner === 'product')
												{{ HTML::link(route('admin.catalogs.products.show', array($image->product->catalog_id, $image->product_id)), $image->$key->$label['attr'], array( 'title' => 'Ver producto' ) ) }}
											@elseif($owner === 'gallery')
												{{ HTML::link(route('admin.galleries.show', $image->gallery_id), $image->$key->$label['attr'], array( 'title' => 'Ver galeria' ) ) }}
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
										{{ HTML::link(route("admin.$owner_plural.images.edit", array($image->$owner->id, $image->id)), $image->name) }}
									@endif

								@else
										{{ $image->$key }}
								@endif
							</td>
					@endforeach
					<td>
						<div class="btn-group">
							{{--<a href="{{ route('admin.images.show', array($image->id, $image->id) ) }}"><button class="btn" title="Inspeccionar imagen"><i class="icon-eye-open"></i></button></a>--}}
							<a href="{{ route("admin.$owner_plural.images.edit", array($image->$owner->id, $image->id) ) }}"><button class="btn" title="Modificar imagen"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="{{ route("admin.$owner_plural.images.destroy", array($image->$owner->id, $image->id)) }}" onclick="return confirm('¿Esta seguro que desea eliminar la imagen \'{{ $image->name }}\' relacionada?')"><button class="btn" title="Eliminar imagen"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Products pagination --}}
	{{-- $images->links() --}}
@stop