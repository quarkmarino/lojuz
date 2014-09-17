@extends('admin.clients.layouts.main')

@section('title')
	<h3>Cliente: "{{ $client->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.clients.index') }}"><i class="icon-folder-open"></i>Clientes</a></li>
	<span class="divider">/</span>
	<li><a href="{{ route('admin.clients.show', $client->id) }}"><i class="icon-file"></i>{{ $client->name }}</a></li>
	<span class="divider">/</span>
	<li class="active"><i class="icon-pencil"></i>Editar</li>
@stop

@section('css')
	@parent
	<link rel="stylesheet" type="text/css" href="/css/datepicker/datepicker.css"/>
@stop

@section('javascript')
	@parent
	<script src="/js/datepicker/bootstrap-datepicker.js"></script>
@stop

@section('buttons')
	{{--<a href="{{ route('admin.clients.index') }}">
		<button class="btn" title="Listar clientes"><i class="icon-list"></i> Listar</button>
	</a>--}}
	<a href="{{ route('admin.clients.show', $client->id) }}">
		<button class="btn" title="Volver a clientes"><i class="icon-backward"></i> Volver</button>
	</a>
	<a class="delete" href="{{ route('admin.clients.destroy',$client->id) }}" onclick="return confirm('¿Esta seguro que desea eliminar el cliente \'{{ $client->name }}\'?')">
		<button class="btn" title="Eliminar cliente"><i class="icon-trash"></i> Eliminar</button>
	</a>
@stop

@section('content')
	@parent
	<div class="row-fluid">
		<div class="span12">
			<div class="alert-box text-success">
				@if(Session::has('success'))
					<h3>{{ Session::get('success') }}</h3>
				@endif
			</div>
			<div class="alert-box text-error">
				@if(Session::has('error'))
					<h3>{{ Session::get('error') }}</h3>
				@endif
			</div>
			<ul class="errors">
				@foreach($errors->all() as $message)
				<li>{{ $message }}</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<h3>Detalles</h3>
			<div class="page-inner">
				{{ Form::model($client, array('route' => array('admin.clients.update', $client->id), 'class' => 'af-form form-horizontal', 'id' => 'client-form', 'files' => true, 'method' => 'put') ) }}
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputName">Nombre</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-font"></i></span>
										{{ Form::text('name', Input::old('name'), array('placeholder' => 'Nombre', 'class' => 'span12', 'id' => 'inputName')) }}
									</div>
								</div>
							</div>
						</div>
						<div class="af-outer af-required">
							<div class="af-inner">
								<div class="control-group">
									<label class="control-label" for="inputComment">Comentario</label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on">''</span>
												{{ Form::textarea('comment', Input::old('comment'), array('placeholder' => 'Un comentario para este cliente', 'class' => 'input-large', 'id' => 'inputDescription', 'rows' => 3)) }}
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="af-outer af-required">
							<div class="af-inner">
								<div class="control-group">
									<label class="control-label" for="inputTags">Desde</label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-calendar"></i></span>
											{{ Form::text('since', Input::old('since'), array('placeholder' => 'Desde cuando es un cliente', 'class' => 'span12 datepicker', 'id' => 'inputSince')) }}
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="af-outer af-required">
							<div class="af-inner">
								<div class="control-group">
									<label class="control-label" for="inputStatus">Visibilidad</label>
									<div class="controls">
										<label class="radio">
											{{ Form::radio('status', '1', true, array('id' => 'inputStatus')) }} Estara <span class="text-success">visible</span> al publico
										</label>
										<label class="radio">
											{{ Form::radio('status', '0') }} Estara <span class="text-warning">oculto</span> al publico
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="af-outer af-required">
							<div class="af-inner">
								<div class="control-group">
									<label class="control-label" for="inputImageFile">Logo</label>
									<div class="controls">
										{{ Form::file('logo', array('id' => 'inputImageFile')); }}
									</div>
								</div>
							</div>
						</div>
						<div class="af-outer af-required">
							<div class="af-inner" style="height: 20px;">
								<div class="pull-right">
									<input type="submit" name="submit" class="btn btn-primary" id="submit_btn" value="Guardar">
									<a href="{{ route('admin.clients.show', $client->id) }}">
										<button type="button" class="btn">Cancel</button>
									</a>
									<br />
								</div>
							</div>
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
		<div class="span6">
			<div class="row-fluid">
				<div class="span7">
					<h3>Imagen <span class="spinner" style="display: none;"><i class="icon-refresh icon-spin"></i></span></h3>
				</div>
				<div class="span5">
					
				</div>
			</div>
			<div class="page-inner" id='productImages'>
				@if($client->logo !== null)
					<section class="row-fluid portfolio thumbnails">
						<article data-id="id-{{ $client->id }}" data-type="javascript html" class="span12">
							<div class="thumbnail hover-pf1">
								{{ HTML::image( $client->slide, $client->name, array('class' => 'img-rounded', 'title' => $client->name)); }}
								{{--<img src="example/latest1.jpg" alt="">--}}
								<div class="mask-1"></div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2>
										<a class="title" href="{{ route('admin.clients.edit', $client->id) }}", title="Editar imagen"><i class="icon-pencil"></i> {{ $client->name }}</a>
									</h2>
								</div>
							</div>
						</article>
					</section>
				@else
					<p>
						Este cliente no tiene ningun logo asociado.
					</p>
				@endif
			</div>
		</div>
	</div>
@stop