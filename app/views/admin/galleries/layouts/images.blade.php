@extends('admin.galleries.layouts.main')

@section('head_title')
	@parent
	- Imagenes
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.galleries.index') }}"><i class="icon-folder-open"></i>Galerias</a></li><span class="divider">/</span>
@stop