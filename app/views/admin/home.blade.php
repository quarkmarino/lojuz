@extends('admin.layouts.main')

@section('head_title')
	Información
@stop

@section('nav')
	<?php $nav['options'] = array('active_item' => 'Admin'); ?>
	@parent
@stop

@section('breadcrumbs')
	<li><a href="/"><i class="icon-home"></i>Lojuz</a></li>
	<span class="divider">/</span>
	<li class="active"><i class="icon-wrench"></i>Administración</li>
@stop

@section('content')
	Dashboard<br>
@stop