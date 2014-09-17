@extends('admin.clients.layouts.main')

@section('title')
	<h3>Clientes</h3>
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><i class="icon-folder-open"></i>Clientes</li>
@stop

@section('buttons')
	<a href="clients/create"><button class="btn" title="Crear nuevo cliente"><i class="icon-plus"></i> Crear</button></a>
@stop

@section('content')
	@parent
	<table class="table table-striped table-hover table-bordered">
		<caption>Lista de Clientes</caption>
		<thead>
			<tr>
				<th title="#">id</th>
				<th title="Nombre de la galeria">Nombre</th>
				<th title="Desde (fecha)">A partir de:</th>
				<th title="Visibilidad del cliente">Estatus</th>
				<th title="Logo"><i class="icon-picture"></i></th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($clients as $client)
				<tr>
					<td>{{ $client->id }}</td>
					<td>
						<a href="{{ route('admin.clients.show', $client->id) }}" title="Ver Cliente">{{ $client->name }}</a>
					</td>
					<td>{{ $client->since }}</td>
					<td>
						<?php $values = array( 'label' => array( 'Oculta', 'Visible' ), 'emph' => array( 'text-warning', 'text-success' ) ); ?>
						<span class="{{ $values['emph'][$client->status] }}">{{ $values['label'][$client->status] }}</span>
					</td>
					<td>
						{{ HTML::image( $client->tinythumb, $client->name, array('title' => $client->name)); }}
					</td>
					<td>
						<div class="btn-group">
							<a href="clients/{{ $client->id }}"><button class="btn" title="Inspeccionar clientes"><i class="icon-eye-open"></i></button></a>
							<a href="clients/{{ $client->id }}/edit"><button class="btn" title="Modificar clientes"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="clients/{{ $client->id }}/delete" onclick="return confirm('¿Esta seguro que desea eliminar el clientes \'{{ $client->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar clientes"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Catalogs pagination --}}
	{{ $clients->links() }}
@stop

{{--@section('javascript')
	@parent
	<script type="text/javascript">
		$(document).ready(function(){			
			$(".delete").on('click', function(event) {
				event.preventDefault();
				$.ajax({
					url: 'clients/' + $(this).data('clients_id'),
					type: 'DELETE',
					//data: $("#delete").serializeArray(),
					success: function(data) { $("#results").html(data); }
				}); 
			});
		});
	</script>
@stop--}}