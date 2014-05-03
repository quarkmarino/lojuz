@extends('admin.products.layouts.main')

@section('title')
	<h3>Nuevo Producto</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.catalogs.show', $catalog->id) }}"><i class="icon-file"></i>{{ $catalog->name }}</a></li><span class="divider">/</span>
	<li><a href="{{ route('admin.catalogs.products.index', $catalog->id) }}"><i class="icon-folder-open"></i>Productos</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-plus"></i>Crear</li>
@stop

@section('buttons')
	<a href="{{ route('admin.catalogs.products.index', $catalog->id) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles del producto?')"><button class="btn" title="Listar productos"><i class="icon-list"></i> Listar</button></a>
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
				{{ Form::open( array('route' => array('admin.catalogs.products.store', $catalog->id), 'class' => 'af-form form-horizontal', 'id' => 'product-form') ) }}
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputCatalogs">Catálogo</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">@</span>
										{{ Form::text('catalog_id', $catalog->name, array('placeholder' => $catalog->name, 'class' => 'span12', 'id' => 'inputCatalog', 'disabled' => 'disabled')) }}
									</div>
								</div>
							</div>
						</div>
					</div>
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
											{{ Form::textarea('description', Input::old('description'), array('placeholder' => 'Descripción del producto', 'class' => 'input-large', 'id' => 'inputDescription', 'rows' => 3)) }}
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
								<label class="control-label" for="inputType">Tipo</label>
								<div class="controls">
									<label class="radio">
										{{ Form::radio('type', 'product', true, array('id' => 'inputType')) }} Es un producto
									</label>
									<label class="radio">
										{{ Form::radio('type', 'service') }} Es un servicio
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputPrice">Precio</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">$</span>
										{{ Form::text('price', Input::old('price'), array('placeholder' => 'Precio', 'class' => 'span12', 'id' => 'inputPrice')) }}
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
								<a href="{{ route('admin.catalogs.products.index') }}">
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
			<h3>Imagenes</h3>
			<div class="page-inner">
				<p>
					La carga de imagenes estara disponible en el formulario de edición, una vez que se haya creado el producto/servicio.
				</p>
			</div>
		</div>
	</div>
@stop