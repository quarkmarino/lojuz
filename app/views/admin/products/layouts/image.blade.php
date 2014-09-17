@extends('admin.catalogs.layouts.main')

@section('head_title')
	@parent
	- Imagenes
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.catalogs.index') }}">
		<i class="icon-folder-open"></i>Catálogos
	</a></li>
	<span class="divider">/</span>
	@if(isset($owner))
		<li><a href="{{ route("admin.catalogs.show", $owner->catalog_id) }}">
			<i class="icon-file"></i>{{ $owner->catalog->name }}
		</a></li>
		<span class="divider">/</span>
		<li><a href="{{ route("admin.catalogs.products.index", $owner->catalog_id) }}">
			<i class="icon-folder-open"></i>Productos
		</a></li>
		<span class="divider">/</span>
	@else
		<li class="active">
			<i class="icon-folder-open"></i>Productos
		</li>
		<span class="divider">/</span>
	@endif
	@if(isset($owner))
		<li><a href="{{ route("admin.catalogs.products.show", array($owner->catalog_id, $owner->id)) }}">
			<i class="icon-file"></i>{{ $owner->name }}
		</a></li>
		<span class="divider">/</span>
	@endif
@stop

@section('buttons')
	@parent
	@if(isset($owner))
		<a href="{{ route("admin.catalogs.products.edit", array($owner->catalog_id, $owner->id)) }}">
			<button class="btn" title="Volver al producto"><i class="icon-backward"></i> Volver</button>
		</a>
	@endif
	{{--<a class="btn" href="{{ route('admin.products.images.destroy', array($owner->id, $image->id)) }}" onclick='return confirm("¿Esta seguro que desea eliminar la imagen del producto?")', title="Eliminar imagen">
		<i class="icon-trash"> Eliminar</i>
	</a>--}}
@stop