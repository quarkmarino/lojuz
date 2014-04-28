@extends('admin.layouts.main')

@section('head_title')
	Imagenes
@stop

@section('nav')
	<?php $nav['options'] = array('active_item' => 'Admin'); ?>
	@parent
@stop

@section('javascript')
	@parent
@stop

@section('breadcrumbs')
	@parent
	<li><a href="dashboard">Administración</a></li><span class="divider">/</span>
	<li class="active">Imagenes</li>
@stop

@section('content')
	<div class="row-fluid">
		<div class="span6">
			@section('title')
			@show
		</div>
		<div class="span6">
			<div class="btn-toolbar pull-right">
				<div class="btn-group">
					@section('buttons')
					@show
				</div>
			</div>
		</div>
	</div>
@stop

@section('footer')
	@parent
@stop