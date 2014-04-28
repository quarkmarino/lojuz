@extends('admin.layouts.main')

@section('head_title')
	Galerias
@stop

@section('nav')
	<?php $nav['options'] = array('active_item' => 'Admin'); ?>
	@parent
@stop

@section('content')
	<div class="row-fluid">
		<div class="span8">
			@section('title')
			@show
		</div>
		<div class="span4">
			<div class="btn-toolbar pull-right">
				<div class="btn-group">
					@section('buttons')
					@show
				</div>
			</div>
		</div>
	</div>
@stop