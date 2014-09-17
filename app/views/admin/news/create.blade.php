@extends('admin.news.layouts.main')

@section('title')
	<h3>Nueva Noticia</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.news.index') }}"><i class="icon-folder-open"></i>Noticias</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-plus"></i>Crear</li>
@stop

{{--@section('css')
	@parent
	<link rel="stylesheet" type="text/css" href="/css/datepicker/datepicker.css"/>
@stop--}}

{{--@section('javascript')
	@parent
	<script src="/js/datepicker/bootstrap-datepicker.js"></script>
@stop--}}

@section('buttons')
	{{--<a href="{{ route('admin.news.index') }}">
		<button class="btn" title="Listar clientes"><i class="icon-list"></i> Listar</button>
	</a>--}}
	<a href="{{ route('admin.news.index') }}">
		<button class="btn" title="Volver a clientes"><i class="icon-backward"></i> Volver</button>
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
				{{ Form::open( array('route' => 'admin.news.store', 'class' => 'af-form form-horizontal', 'id' => 'client-form', 'files' => true) ) }}
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputName">Titulo</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-font"></i></span>
										{{ Form::text('title', Input::old('title'), array('placeholder' => 'Titulo', 'class' => 'span12', 'id' => 'inputName')) }}
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputComment">Mensaje</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">''</span>
											{{ Form::textarea('message', Input::old('message'), array('placeholder' => 'El mensaje de la noticia', 'class' => 'input-large', 'id' => 'inputMessage', 'rows' => 3)) }}
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputComment">Producto</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">''</span>
											{{ Form::select('product_id', $options, array('placeholder' => 'Elige el producto asociado a esta noticia', 'class' => 'input-large', 'id' => 'inputProduct', 'rows' => 3)) }}
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{--<div class="af-outer af-required">
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
					</div>--}}
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
					{{--<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputImageFile">Logo</label>
								<div class="controls">
									{{ Form::file('logo', array('id' => 'inputImageFile')); }}
								</div>
							</div>
						</div>
					</div>--}}
					<div class="af-outer af-required">
						<div class="af-inner" style="height: 20px;">
							<div class="pull-right">
								<input type="submit" name="submit" class="btn btn-primary" id="submit_btn" value="Crear">
								<a href="{{ route('admin.news.index') }}">
									<button type="button" class="btn">Cancel</button>
								</a>
								<br />
							</div>
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
		{{--<div class="span6">
			<h3>Productos</h3>
			<div class="page-inner">
				<p>
					Los productos se podran agregar una vez que se haya creado el cliente, desde el formulario de creación de productos.
				</p>
			</div>
		</div>--}}
	</div>
@stop

{{--@section('footer')
	@parent
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {

			var nowTemp = new Date();
			var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
			 
			var checkin = $('.datepicker').datepicker({
				onRender: function(date) {
					return date.valueOf() > now.valueOf() ? 'disabled' : '';
				}
			}).data('datepicker');
		});
	</script>
@stop--}}