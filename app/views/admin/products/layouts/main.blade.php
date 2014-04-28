@extends('admin.catalogs.layouts.main')

@section('head_title')
	@parent
	- Productos
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.catalogs.index') }}"><i class="icon-folder-open"></i>Catálogos</a></li><span class="divider">/</span>
@stop