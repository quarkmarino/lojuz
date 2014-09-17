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
					<th title="#">id</th>
					<th title="Nombre de la galeria">Nombre</th>
					<th title="Descripción de la galeria">Descripción</th>
					<th title="Etiquetas del catálogo">Etiquetas</th>
					<th title="Visibilidad del catálogo">Estatus</th>
					<th title="# de Imagenes"><i class="icon-picture"></i></th>
					<th colspan="3">Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($galleries as $gallery)
				<tr>
					<td>{{ $gallery->id }}</td>
					<td>
						<a href="{{ route('admin.galleries.show', $gallery->id) }}" title="Ver Galeria">{{ $gallery->name }}</a>
					</td>
					<td>{{ $gallery->description }}</td>
					<td>
						{{ implode(', ', array_slice(explode(', ', $gallery->tags), 0, 3)).( count(explode(', ', $gallery->tags)) > 3 ? HTML::link(route('admin.galleries.show', $gallery->id), ', ...') : '' ) }}
					</td>
					<td>
						<?php $values = array( 'label' => array( 'Oculta', 'Visible' ), 'emph' => array( 'text-warning', 'text-success' ) ); ?>
						<span class="{{ $values['emph'][$gallery->status] }}">{{ $values['label'][$gallery->status] }}</span>
					</td>
					<td>
						<a href="{{ route('admin.galleries.images.index', $gallery->id) }}" title="Ver Imagenes">
							{{ $gallery->images->count() }}
						</a>
					</td>
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