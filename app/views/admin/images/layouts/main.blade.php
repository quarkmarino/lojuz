@extends('admin.layouts.main')

@section('head_title')
	Imagenes
@stop

@section('breadcrumbs')
	@parent
@stop

@section('buttons')
	@parent
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