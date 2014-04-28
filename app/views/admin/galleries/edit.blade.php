@extends('admin.galleries.layouts.main')

@section('title')
	<h3>Galeria: "{{ $gallery->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.galleries.index') }}"><i class="icon-folder-open"></i>Galerias</a></li><span class="divider">/</span>
	<li><a href="{{ route('admin.galleries.show', $gallery->id) }}"><i class="icon-file"></i>{{ $gallery->name }}</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-pencil"></i>Editar</li>
@stop

@section('javascript')
	@parent
	<script src="http://malsup.github.com/jquery.form.js"></script>
@stop

@section('buttons')
	<a href="{{ route('admin.galleries.create') }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de la galeria?')"><button class="btn" title="Crear nuevo galeria"><i class="icon-plus"></i> Crear</button></a>
	<a href="{{ route('admin.galleries.index') }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de la galeria?')"><button class="btn" title="Listar galerias"><i class="icon-list"></i> Listar</button></a>
	<a href="{{ route('admin.galleries.show', $gallery->id) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de la galeria?')"><button class="btn" title="Ver este galeria"><i class="icon-eye-open"></i> Ver</button></a>
	<a class="delete" href="{{ route('admin.galleries.destroy', $gallery->id) }}" onclick="return confirm('¿Esta seguro que desea eliminar la galeria \'{{ $gallery->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar galeria"><i class="icon-trash"></i> Eliminar</button></a>
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
				{{ Form::model($gallery, array('route' => array('admin.galleries.update', $gallery->id), 'class' => 'af-form form-horizontal', 'id' => 'product-form', 'method' => 'put') ) }}
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
											{{ Form::textarea('description', Input::old('description'), array('placeholder' => 'Descripción del galeria', 'class' => 'input-large', 'id' => 'inputDescription', 'rows' => 3)) }}
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
						<div class="af-inner">
							<br>
							<input type="submit" name="submit" class="btn btn-primary" id="product-submit_btn" value="Guardar">
							<a href="{{ route('admin.galleries.show', $gallery->id) }}"><button type="button" class="btn">Cancel</button></a>
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
		<div class="span6">
			<h3>Imagenes <span class="spinner" style="display: none;"><i class="icon-refresh icon-spin"></i></span></h3>
			<div class="page-inner" id='productImages'>
				{{ Form::model($imageInstance, array('route' => array('admin.galleries.images.store', $gallery->id), 'class' => 'af-form form-horizontal', 'id' => 'image-form', 'files' => true) ) }}
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputImageName">Nombre</label>
								<div class="controls">
									<div class="input-prepend">
									<span class="add-on"><i class="icon-font"></i></span>
										{{ Form::text('name', '', array('placeholder' => 'Nombre de imagen', 'class' => 'span12', 'id' => 'inputImageName')) }}
									</span>
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
										{{ Form::text('comment', '', array('placeholder' => 'Comentario de imagen', 'class' => 'span12', 'id' => 'inputImageComment')) }}
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputImage">Archivo</label>
								<div class="controls">
									{{ Form::file('file', array('id' => 'inputImageFile')); }}
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="span12">
							<div class="af-outer af-required">
								<div class="af-inner">
									<input type="button" class="btn btn-primary pull-right" id="image-submit_btn" value="Cargar">
								</div>
							</div>
						</div>
					</div>
				{{ Form::close() }}
				<section class="row-fluid portfolio thumbnails">
					<?php $i = 0; ?>
					@foreach($gallery->images as $image)
						<article data-id="id-{{ $image->id }}" data-type="javascript html" class="span6">
							<div class="thumbnail hover-pf1">
								{{ HTML::image($image->largethumb, $image->name, array('class' => 'img-rounded', 'title' => $image->name)); }}
								{{--<img src="example/latest1.jpg" alt="">--}}
								<div class="mask-1"></div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2><a class="title" href="{{ route('admin.galleries.images.show', $image->id) }}", title="Ver imagen"><i class="icon-eye-open"></i> {{ $image->name }}</a></h2>
									<a class="info btn btn-small btn-inverse" href="{{ route('admin.galleries.images.destroy', array( $gallery->id, $image->id )) }}" onclick='return confirm("¿Esta seguro que desea eliminar la imagen relacionada a este galeria?")', title="Eliminar imagen"><i class="icon-trash"></i></a>
									{{-- HTML::link(
										route('admin.galleries.images.destroy',
											array('product' => $gallery->id, 'id' => $image->id)
										), 
										'<i class="icon-trash"></i>',
										array(
											'class' => 'delete info btn btn-inverse',
											'title' => 'Eliminar imagen',
											'onClick' => 'return confirm("¿Esta seguro que desea eliminar la imagen relacionada a este galeria?")'
										)
									) --}}
								</div>
							</div>
						</article>
						@if(++$i % 2 == 0 && $i > 0)
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
		var item = '<article data-id="id-'+response.id+'" data-type="javascript html" class="span6"><div class="thumbnail hover-pf1"><img src="'+response.file+'" alt="'+response.name+'" class="img-rounded"><div class="mask-1"></div><div class="mask-2"></div><div class="caption"><h2><a class="title" href="images/'+response.id+'", title="Ver imagen"><i class="icon-eye-open"></i> '+response.name+'</a></h2><a class="info btn btn-small btn-inverse" href="images/'+response.id+'/delete" onclick="return confirm(\"¿Esta seguro que desea eliminar la imagen relacionada a este galeria?\")", title="Eliminar imagen"><i class="icon-trash"></i></a></div></div></article>';
			return item;
	}
	</script>
@stop