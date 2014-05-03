@extends('admin.catalogs.layouts.main')

@section('title')
	<h3>Nuevo Catalogo</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.catalogs.index') }}"><i class="icon-folder-open"></i>Catálogos</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-plus"></i>Crear</li>
@stop

@section('buttons')
	<a href="{{ route('admin.catalogs.index') }}"><button class="btn" title="Listar productos"><i class="icon-list"></i> Listar</button></a>
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
				{{ Form::open( array('route' => 'admin.catalogs.store', 'class' => 'af-form form-horizontal', 'id' => 'product-form') ) }}
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
								<label class="control-label" for="inputComment">Descripción</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">''</span>
											{{ Form::textarea('description', '', array('placeholder' => 'Descripción del catalogo', 'class' => 'input-large', 'id' => 'inputDescription', 'rows' => 6)) }}
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputTags">Etiquetas</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-tags"></i></span>
										{{ Form::text('tags', Input::old('tags'), array('placeholder' => 'Etiquetas, separadas por comas', 'class' => 'span12', 'id' => 'inputTags')) }}
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
						<div class="af-inner" style="height: 20px;">
							<div class="pull-right">
								<input type="submit" name="submit" class="btn btn-primary" id="submit_btn" value="Crear">
								<a href="{{ route('admin.catalogs.show', $catalog->id) }}">
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
			<h3>Productos</h3>
			<div class="page-inner">
				<p>
					Los productos se podran agregar una vez que se haya creado el catalogo, desde el formulario de creación de productos.
				</p>
			</div>
		</div>
	</div>
@stop