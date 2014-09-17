@extends('admin.galleries.layouts.main')

@section('head_title')
	@parent
	- Imagenes
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.galleries.index') }}">
		<i class="icon-folder-open"></i>Galerias
	</a></li>
	<span class="divider">/</span>
	@if(isset($owner))
		<li><a href="{{ route("admin.galleries.show", $owner->id) }}">
			<i class="icon-file"></i>{{ $owner->name }}
		</a></li>
		<span class="divider">/</span>
	@endif
@stop

@section('buttons')
	@parent
	@if(isset($owner))
		<a href="{{ route("admin.galleries.edit", $owner->id) }}">
			<button class="btn" title="Volver a la galeria"><i class="icon-backward"></i> Volver</button>
		</a>
	@endif
	{{--<a class="btn" href="{{ route('admin.galleries.images.destroy', array($owner->id, $image->id)) }}" onclick='return confirm("¿Esta seguro que desea eliminar la imagen de la galeria?")', title="Eliminar imagen">
		<i class="icon-trash"> Eliminar</i>
	</a>--}}
@stop