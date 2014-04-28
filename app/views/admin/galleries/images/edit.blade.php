@extends('admin.galleries.layouts.images')

@section('title')
	<h3>Producto: "{{ $image->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.galleries.show', $gallery->id) }}"><i class="icon-file"></i>{{ $gallery->name }}</a></li><span class="divider">/</span>
	<li><a href="{{ route('admin.galleries.images.index', $gallery->id) }}"><i class="icon-folder-open"></i>Imagenes</a></li><span class="divider">/</span>
	<li><a href="{{ route('admin.galleries.images.show', array($gallery->id, $image->id)) }}"><i class="icon-file"></i>{{ $image->name }}</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-pencil"></i>Editar</li>
@stop

@section('javascript')
	@parent
	<script src="http://malsup.github.com/jquery.form.js"></script>
@stop

@section('buttons')
	<a href="{{ route('admin.galleries.images.create', $gallery->id) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de la imagen?')"><button class="btn" title="Crear nuevo imagen"><i class="icon-plus"></i> Crear</button></a>

	<a href="{{ route('admin.galleries.images.index', $gallery->id) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de la imagen?')"><button class="btn" title="Listar imagenes"><i class="icon-list"></i> Listar</button></a>

	<a href="{{ route('admin.galleries.images.show', array($gallery->id, $image->id)) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de la imagen?')"><button class="btn" title="Ver esta imagen"><i class="icon-eye-open"></i> Ver</button></a>

	<a class="delete" href="{{ route('admin.galleries.images.destroy', array($gallery->id, $image->id)) }}" onclick="return confirm('¿Esta seguro que desea eliminar el imagen \'{{ $image->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar imagen"><i class="icon-trash"></i> Eliminar</button></a>
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
		<div class="span5">
			<h3>Detalles</h3>
			<div class="page-inner">
				{{ Form::model($image, array('route' => array('admin.galleries.images.update', $gallery->id, $image->id), 'class' => 'af-form form-horizontal', 'id' => 'product-form', 'method' => 'put') ) }}
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputCatalog_id">Catalogo</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">@</span>
										{{ Form::text('gallery_id', $gallery->name, array('placeholder' => $gallery->name, 'class' => 'span12', 'id' => 'inputCatalog', 'disabled' => 'disabled')) }}
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
					</div>
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputComment">Descripción</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">''</span>
											{{ Form::textarea('comment', Input::old('comment'), array('placeholder' => 'Descripción de la imagen', 'class' => 'input-large', 'id' => 'inputDescription', 'rows' => 3)) }}
										</span>
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
							<br>
							<input type="submit" name="submit" class="btn btn-primary" id="product-submit_btn" value="Guardar">
							<a href="{{ route('admin.galleries.images.show', array($gallery->id, $image->id)) }}"><button type="button" class="btn">Cancel</button></a>
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
		<div class="span7">
			<div class="row-fluid">
				<div class="span7">
					<h3>Tamaños</h3>
				</div>
				<div class="span5">
					<div class="btn-toolbar clearfix">
						<div class="btn-group pull-right">
							<a href="{{ route('admin.galleries.images.edit', array($gallery->id, $image->id)) }}"><button class="btn" title="Modificar detalles y tamaños de esta imagen"><i class="icon-plus"></i> Cambiar imagenes</button></a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner">
				<section class="row-fluid portfolio thumbnails">
					<?php $span = 0; ?>
					@foreach(array('slide' => array( 'title' => 'Slide', 'span' => 12 ), 'largethumb' => array( 'title' => 'Miniatura G', 'span' => 4 ), 'thumb' => array( 'title' => 'Miniatura M', 'span' => 4 ), 'minithumb' => array( 'title' => 'Miniatura C', 'span' => 4 ), ) as $picture => $label)
						<article data-id="id-{{ $image->id }}" data-type="javascript html" class="span{{ $label['span'] }}">
							<?php $span += $label['span']; ?>
							<div class="thumbnail hover-pf1">
								{{ HTML::image($image->$picture, $image->label, array('class' => 'img-rounded')); }}
								{{--<img src="example/latest1.jpg" alt="">--}}
								<div class="mask-1"></div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2><a class="title" href="{{ route('admin.galleries.images.show', array($gallery->id, $image->id)) }}", title="Ver imagen" target="_black"><i class="icon-eye-open"></i> Ver {{ $label['title'] }}</a></h2>
								</div>
							</div>
						</article>
						@if($span % 12 == 0 && $span > 0)
							<?php $span = 0; ?>
				</section>
				<section class="row-fluid portfolio thumbnails">
						@endif
					@endforeach
				</section>
			</div>
		</div>
	</div>
@stop

@section('footer')
	@parent
	<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var options = {
			beforeSubmit:  showRequest,
			success:		showResponse,
			dataType: 'json' 
		};
		$('body').delegate('#image-submit_btn','click', function(e){
			$('#image-form').ajaxForm(options).submit();
		});
	});

	function showRequest(formData, jqForm, options){
		$(".alert-box").empty();
		$("ul.errors").empty();
		$("span.spinner").css('display', 'inline');
		//$("#output").css('display','none');
		return true;
	}
	
	function showResponse(response, statusText, xhr, $form){
		if(response.success == false){
			var arr = response.errors;
			$('div.text-error').prepend('<h3>'+ response.error +'</h3>');
			$.each(arr, function(index, value){
				if (value.length != 0){
					$("ul.errors").append('<li>'+ 
						value
					 +'</li>');
				}
			});
			//$("#validation-errors").show();
		}
		else{
			var lastImagesRow = $('section.portfolio').last();
			if(lastImagesRow.children().length >= 2){
				$('#productImages').append('<section class="row-fluid portfolio thumbnails"></section>');
				lastImagesRow = $('section.portfolio').last();
			}
			lastImagesRow.append(createItem(response));
			$('#inputImageName').val('');
			$('#inputImageComment').val('');
			$('#inputImageFile').val('');
			//$("#output").css('display','block');
		}
		$("span.spinner").css('display', 'none');
	}

	function createItem(response){
		var item = '<article data-id="id-'+response.id+'" data-type="javascript html" class="span6"><div class="thumbnail hover-pf1"><img src="'+response.file+'" alt="'+response.name+'" class="img-rounded"><div class="mask-1"></div><div class="mask-2"></div><div class="caption"><h2><a class="title" href="images/'+response.id+'", title="Ver imagen"><i class="icon-eye-open"></i> '+response.name+'</a></h2><a class="info btn btn-small btn-inverse" href="images/'+response.id+'/delete" onclick="return confirm(\"¿Esta seguro que desea eliminar la imagen relacionada a esta imagen?\")", title="Eliminar imagen"><i class="icon-trash"></i></a></div></div></article>';
			return item;
	}
	</script>
@stop