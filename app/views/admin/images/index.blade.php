<?php $owner_class = strtolower(basename(strtr(get_class($owner), "\\", "/"))); ?>
<?php $owner_class_plural = str_plural($owner_class); ?>

@extends("admin.$owner_class_plural.layouts.image")

@section('title')
	<h3>Imagenes</h3>
@stop

@section('breadcrumbs')
	@parent
	{{--<li><a href="{{ route('admin.images.show', $image->id) }}"><i class="icon-file"></i>{{ $image->name }}</a></li><span class="divider">/</span>--}}
	<li class="active"><i class="icon-folder-open"></i>Imagenes</li>
@stop


@section('buttons')
	{{--<a href="{{ route('admin.images.show', $image->id) }}"><button class="btn" title="Volver al producto"><i class="icon-backward"></i> Volver</button></a>
	<a href="{{ route('admin.images.create', $image->id) }}"><button class="btn" title="Crear nueva imagen"><i class="icon-plus"></i> Crear</button></a>--}}
@stop

@section('content')
	@parent
	<table class="table table-striped table-hover table-bordered">
		<caption>Lista de imagenes asignadas actualmente
			@if($owner_class === 'product')
				al {{ Lang::choice($owner_class, 1) }} {{ HTML::link(route('admin.catalogs.products.show', array($owner->catalog_id, $owner->id)), $owner->name) }}
			@elseif($owner_class === 'gallery')
				a la {{ Lang::choice($owner_class, 1) }} {{ HTML::link(route('admin.galleries.show', $owner->id), $owner->name) }}
			@endif
		</caption>
		<thead>
			<tr>
				@foreach(array('id' => '#', 'name' => 'Nombre', $owner_class => Lang::choice($owner_class, 1), 'status' => 'Estatus') as $key => $attribute)
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
						'name' => array( 'label' => 'Nombre', 'link' => route("admin.$owner_class_plural.images.edit", array($owner->id, $image->id)) ),
						$owner_class => array( 'label' => Lang::choice($owner_class, 1), 'attr' => 'name' ),
						'status' => array( 'values' => array( array( 'label' => 'Oculta', 'emph' => 'text-warning' ), array( 'label' => 'Visible', 'emph' => 'text-success' )) ),
						) as $key => $label)
							<td>
								@if( is_array($label) )
									@if( isset( $label['attr'] ) )
										@if( !empty( $image->$key->$label['attr'] ) )
											@if($owner_class === 'product')
												{{ HTML::link(route("admin.catalogs.products.show", array($owner->catalog_id, $owner->id)), $image->$key->$label['attr'], array( 'title' => 'Ver '.Lang::choice($owner_class, 1) ) ) }}
											@elseif($owner_class === 'gallery')
												{{ HTML::link(route("admin.galleries.show", $owner->id), $image->$key->$label['attr'], array( 'title' => 'Ver '.Lang::choice($owner_class, 1) ) ) }}
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
							<a href="{{ route("admin.$owner_class_plural.images.edit", array($owner->id, $image->id)) }}"><button class="btn" title="Modificar imagen"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="{{ route("admin.$owner_class_plural.images.destroy", array($owner->id, $image->id)) }}" onclick="return confirm('¿Esta seguro que desea eliminar la imagen \'{{ $image->name }}\' relacionada?')"><button class="btn" title="Eliminar imagen"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Products pagination --}}
	{{ $images->links() }}
@stop