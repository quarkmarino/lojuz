@extends('admin.catalogs.layouts.main')

@section('title')
	<h3>Catalogos</h3>
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><i class="icon-folder-open"></i>Catálogos</li>
@stop

@section('buttons')
	<a href="catalogs/create"><button class="btn" title="Crear nuevo catalogo"><i class="icon-plus"></i> Crear</button></a>
@stop

@section('content')
	@parent
	<table class="table table-striped table-hover table-bordered">
		<caption>Lista de Catálogos</caption>
		<thead>
			<tr>
				<th title="#">id</th>
				<th title="Nombre del catálogo">Nombre</th>
				<th title="Etiquetas del catálogo">Etiquetas</th>
				<th title="Visibilidad del catálogo">Estatus</th>
				<th title="# de Productos asociados"><i class="icon-list-alt"></i></th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($catalogs as $catalog)
				<tr>
					<td>{{ $catalog->id }}</td>
					<td>
						<a href="{{ route('admin.catalogs.show', $catalog->id) }}" title="Ver Catálogo">{{ $catalog->name }}</a>
					</td>
					<td>
						{{ implode(', ', array_slice(explode(', ', $catalog->tags), 0, 3)).( count(explode(', ', $catalog->tags)) > 3 ? HTML::link(route('admin.catalogs.show', $catalog->id), ', ...') : '' ) }}
					</td>
					<td>
						<?php $values = array( 'label' => array( 'Oculta', 'Visible' ), 'emph' => array( 'text-warning', 'text-success' ) ); ?>
						<span class="{{ $values['emph'][$catalog->status] }}">{{ $values['label'][$catalog->status] }}</span>
					</td>
					<td>
						<a href="{{ route('admin.catalogs.products.index', $catalog->id) }}" title="Ver Productos">{{ $catalog->products->count() }}</a>
					</td>
					<td>
						<div class="btn-group">
							<a href="catalogs/{{ $catalog->id }}"><button class="btn" title="Inspeccionar catalogos"><i class="icon-eye-open"></i></button></a>
							<a href="catalogs/{{ $catalog->id }}/edit"><button class="btn" title="Modificar catalogos"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="catalogs/{{ $catalog->id }}/delete" onclick="return confirm('¿Esta seguro que desea eliminar el catalogos \'{{ $catalog->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar catalogos"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Catalogs pagination --}}
	{{ $catalogs->links() }}
@stop

{{--@section('javascript')
	@parent
	<script type="text/javascript">
		$(document).ready(function(){			
			$(".delete").on('click', function(event) {
				event.preventDefault();
				$.ajax({
					url: 'catalogs/' + $(this).data('catalogs_id'),
					type: 'DELETE',
					//data: $("#delete").serializeArray(),
					success: function(data) { $("#results").html(data); }
				}); 
			});
		});
	</script>
@stop--}}