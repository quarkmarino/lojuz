@extends('admin.products.layouts.main')

@section('head_title')
	@parent
	- Imagenes
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.products.index') }}"><i class="icon-folder-open"></i>Productos</a></li><span class="divider">/</span>
@stop