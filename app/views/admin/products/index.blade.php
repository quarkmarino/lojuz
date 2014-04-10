@extends('admin.layouts.main')

@section('head_title')
	Información
@stop

@section('nav')
	<?php $nav['options'] = array('active_item' => 'Admin'); ?>
	@parent
@stop

@section('breadcrumbs')
	@parent
	<li class="active">Administración</li>
@stop

@section('content')
	some content<br>
@stop