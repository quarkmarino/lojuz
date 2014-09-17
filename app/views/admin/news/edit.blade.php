@extends('admin.news.layouts.main')

@section('title')
	<h3>Cliente: "{{ $news_item->title }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.news.index') }}"><i class="icon-folder-open"></i>Noticias</a></li>
	<span class="divider">/</span>
	<li><a href="{{ route('admin.news.show', $news_item->id) }}"><i class="icon-file"></i>{{ $news_item->title }}</a></li>
	<span class="divider">/</span>
	<li class="active"><i class="icon-pencil"></i>Editar</li>
@stop

{{--@section('css')
	@parent
	<link rel="stylesheet" type="text/css" href="/css/datepicker/datepicker.css"/>
@stop

@section('javascript')
	@parent
	<script src="/js/datepicker/bootstrap-datepicker.js"></script>
@stop--}}

@section('buttons')
	{{--<a href="{{ route('admin.news.index') }}">
		<button class="btn" title="Listar noticias"><i class="icon-list"></i> Listar</button>
	</a>--}}
	<a href="{{ route('admin.news.show', $news_item->id) }}">
		<button class="btn" title="Volver a noticias"><i class="icon-backward"></i> Volver</button>
	</a>
	<a class="delete" href="{{ route('admin.news.destroy',$news_item->id) }}" onclick="return confirm('¿Esta seguro que desea eliminar el cliente \'{{ $news_item->title }}\'?')">
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
				{{ Form::model($news_item, array('route' => array('admin.news.update', $news_item->id), 'class' => 'af-form form-horizontal', 'id' => 'client-form', 'files' => true, 'method' => 'put') ) }}
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
											{{ Form::select('product_id', $options, $news_item->product_id, array('placeholder' => 'Elige el producto asociado a esta noticia', 'class' => 'input-large', 'id' => 'inputProduct', 'rows' => 3)) }}
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
								<input type="submit" name="submit" class="btn btn-primary" id="submit_btn" value="Guardar">
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
		<div class="span6">
			<div class="row-fluid">
				<div class="span7">
					<h3>Producto</h3>
				</div>
				<div class="span5">
					
				</div>
			</div>
			<div class="page-inner" id='productImages'>
				@if($news_item->product !== null)
					<section class="row-fluid portfolio thumbnails">
						<article data-id="id-{{ $news_item->id }}" data-type="javascript html" class="span6 offset3">
							<div class="thumbnail hover-pf1">
								{{-- HTML::image( $news_item->slide, $news_item->title, array('class' => 'img-rounded', 'title' => $news_item->title)); --}}
								{{--<img src="example/latest1.jpg" alt="">--}}
								<div class="mask-1">{{ $news_item->product->name }}</div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2>
										<a class="title" href="{{ route('admin.news.edit', $news_item->id) }}", title="Editar imagen"><i class="icon-pencil"></i> {{ $news_item->title }}</a>
									</h2>
								</div>
							</div>
						</article>
					</section>
				@else
					<p>
						Esta noticia no tiene ningun producto asociado.
					</p>
				@endif
			</div>
		</div>
	</div>
@stop