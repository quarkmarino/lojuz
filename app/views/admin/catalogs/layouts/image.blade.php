@extends('admin.catalogs.layouts.main')

@section('head_title')
	@parent
	- Imagenes
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route("admin.catalogs.index") }}"><i class="icon-folder-open"></i>Catálogos</a></li>
	<span class="divider">/</span>
	<li><a href="{{ route("admin.catalogs.show", $owner->id) }}"><i class="icon-file"></i>{{ $owner->name }}</a></li>
	<span class="divider">/</span>
@stop

@section('buttons')
	@parent
	<a href="{{ route("admin.catalogs.show", $owner->id) }}">
		<button class="btn" title="Volver al catálogo"><i class="icon-backward"></i> Volver</button>
	</a>
	<a class="btn" href="{{ route('admin.catalogs.images.destroy', array($owner->id, $image->id)) }}" onclick='return confirm("¿Esta seguro que desea eliminar la imagen del catálogo?")', title="Eliminar imagen">
		<i class="icon-trash"></i>
	</a>
@stop