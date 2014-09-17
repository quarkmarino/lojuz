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
				al {{ ucfirst(Lang::choice('messages.'.$owner_class, 1)) }} {{ HTML::link(route('admin.catalogs.products.show', array($owner->catalog_id, $owner->id)), $owner->name) }}
			@elseif($owner_class === 'gallery')
				a la {{ ucfirst(Lang::choice('messages.'.$owner_class, 1)) }} {{ HTML::link(route('admin.galleries.show', $owner->id), $owner->name) }}
			@endif
		</caption>
		<thead>
			<tr>
				<th title="#">id</th>
				<th title="Nombre de imagen">Nombre</th>
				<th title="{{ $owner_class }}">{{ ucfirst(Lang::choice('messages.'.$owner_class, 1)) }}</th>
				<th title="Visibilidad de imagen">Estatus</th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($images as $image)
				<tr>
					<td>{{ $image->id }}</td>
					<td>
						<a href="{{ route("admin.$owner_class_plural.images.edit", array($owner->id, $image->id)) }}" title="Ver Imagen">{{ $image->name }}
						</a>
					</td>
					<td>
						@if($owner_class === 'product')
							{{ HTML::link(route("admin.catalogs.products.show", array($owner->catalog_id, $owner->id)), $image->product->name, array( 'title' => 'Ver '.Lang::choice('messages.'.$owner_class, 1) ) ) }}
						@elseif($owner_class === 'gallery')
							{{ HTML::link(route("admin.galleries.show", $owner->id), $image->gallery->name, array( 'title' => 'Ver '.Lang::choice('messages.'.$owner_class, 1) ) ) }}
						@endif
					</td>
					<td>
						<?php $values = array( 'label' => array( 'Oculta', 'Visible' ), 'emph' => array( 'text-warning', 'text-success' ) ); ?>
						<span class="{{ $values['emph'][$image->status] }}">{{ $values['label'][$image->status] }}</span>
					</td>
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