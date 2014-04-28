@extends('admin.catalogs.layouts.main')

@section('title')
	<h3>Catalogo: "{{ $catalog->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.catalogs.index') }}"><i class="icon-folder-open"></i>Catálogos</a></li>
	<span class="divider">/</span>
	<li><a href="{{ route('admin.catalogs.show', $catalog->id) }}"><i class="icon-file"></i>{{ $catalog->name }}</a></li>
	<span class="divider">/</span>
	<li class="active"><i class="icon-pencil"></i>Editar</li>
	<span class="divider">/</span>
	<li class="active"><a href="{{ route('admin.catalogs.products.index', $catalog->id) }}"><i class="icon-folder-open"></i>Productos</a></li>
@stop

@section('javascript')
	@parent
	<script src="http://malsup.github.com/jquery.form.js"></script>
@stop

@section('buttons')
	<a href="{{ route('admin.catalogs.create') }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de catalogo?')">
		<button class="btn" title="Crear nuevo catalogo"><i class="icon-plus"></i> Crear</button>
	</a>
	<a href="{{ route('admin.catalogs.index') }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de catalogo?')">
		<button class="btn" title="Listar catalogos"><i class="icon-list"></i> Listar</button>
	</a>
	<a href="{{ route('admin.catalogs.show',$catalog->id) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de catalogo?')">
		<button class="btn" title="Ver este catalogo"><i class="icon-eye-open"></i> Ver</button>
	</a>
	<a class="delete" href="{{ route('admin.catalogs.destroy',$catalog->id) }}" onclick="return confirm('¿Esta seguro que desea eliminar el catalogo \'{{ $catalog->name }}\' y todas sus productos relacionados?')">
		<button class="btn" title="Eliminar catalogo"><i class="icon-trash"></i> Eliminar</button>
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
				{{ Form::model($catalog, array('route' => array('admin.catalogs.update', $catalog->id), 'class' => 'af-form form-horizontal', 'id' => 'catalog-form', 'method' => 'put') ) }}
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
								<label class="control-label" for="inputComment">Descripción</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">''</span>
											{{ Form::textarea('description', Input::old('description'), array('placeholder' => 'Descripción del catalogo', 'class' => 'input-large', 'id' => 'inputDescription', 'rows' => 6)) }}
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
							<input type="submit" name="submit" class="btn btn-primary" id="catalog-submit_btn" value="Guardar">
							<a href="{{ route('admin.catalogs.show', $catalog->id) }}">
								<button type="button" class="btn">Cancel</button>
							</a>
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
					<div class="btn-toolbar clearfix">
						<div class="btn-group pull-right">
						</div>
					</div>
				</div>
			</div>
				<div class="page-inner" id='productImages'>
					@if($catalog->image === null)
						{{ Form::model($image, array('route' => array('admin.catalogs.images.store', $catalog->id), 'class' => 'af-form form-horizontal', 'id' => 'image-form', 'files' => true) ) }}
							<div class="af-outer af-required">
								<div class="af-inner">
									<div class="control-group">
										<label class="control-label" for="inputImageName">Nombre</label>
										<div class="controls">
											<div class="input-prepend">
												<span class="add-on"><i class="icon-font"></i></span>
												{{ Form::text('name', '', array('placeholder' => 'Nombre de imagen', 'class' => 'span12', 'id' => 'inputImageName')) }}
											</div>
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
											</div>
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
					@else
						<section class="row-fluid portfolio thumbnails">
							<article data-id="id-{{ $catalog->id }}" data-type="javascript html" class="span12">
								<div class="thumbnail hover-pf1">
									{{ HTML::image( $catalog->image->slide, $catalog->name, array('class' => 'img-rounded', 'title' => $catalog->name)); }}
									{{--<img src="example/latest1.jpg" alt="">--}}
									<div class="mask-1"></div>
									<div class="mask-2"></div>
									<div class="caption">
										<h2>
											<a class="title" href="{{ route('admin.catalogs.images.edit', array($catalog->id, $catalog->image->id)) }}", title="Editar imagen"><i class="icon-pencil"></i> {{ $catalog->image->name }}</a>
										</h2>
										<a class="info btn btn-small btn-inverse" href="{{ route('admin.catalogs.images.destroy', array($catalog->id, $catalog->image->id)) }}" onclick='return confirm("¿Esta seguro que desea eliminar la imagen de catálogo?")', title="Quitar imagen"><i class="icon-trash"></i></a>
									</div>
								</div>
							</article>
						</section>
					@endif
				</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span7">
					<h3><a href="{{ route('admin.catalogs.products.index', $catalog->id) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de catalogo?')">Productos</a></h3>
				</div>
				<div class="span5">
					<div class="btn-toolbar clearfix">
						<div class="btn-group pull-right">
							<a href="{{ route('admin.catalogs.products.create', $catalog->id) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de catalogo?')">
								<button class="btn" title="Crear y agregar un nuevo producto a este catalogo"><i class="icon-plus"></i> Agregar</button>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner" id='catalogProducts'>
				<section class="row-fluid portfolio thumbnails">
					<?php $i = 0; ?>
					@foreach($catalog->products as $product)
						<article data-id="id-{{ $product->id }}" data-type="javascript html" class="span3">
							<div class="thumbnail hover-pf1">
								@if($product->images()->first() !== null)
									<?php $image = $product->images()->first()->toArray(); ?>
									<?php $image = $image['largethumb']; ?>
								@else
									<?php $image = 'images/no-image-largethumb.jpg'; ?>
								@endif
								{{ HTML::image( $image, $product->name, array('class' => 'img-rounded', 'title' => $product->name)); }}
								{{--<img src="example/latest1.jpg" alt="">--}}
								<div class="mask-1"></div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2>
										<a class="title" href="{{ route('admin.catalogs.products.show', array($catalog->id, $product->id)) }}", title="Ver producto"><i class="icon-eye-open"></i> {{ $product->name }}</a>
									</h2>
									<a class="info btn btn-small btn-inverse" href="{{ route('admin.catalogs.products.edit', array($catalog->id, $product->id)) }}", title="Modificar producto"><i class="icon-pencil"></i></a>
									<a class="info btn btn-small btn-inverse" href="{{ route('admin.catalogs.products.unassign', array($catalog->id, $product->id)) }}" onclick='return confirm("¿Esta seguro que desea quitar este producto del catalogo? Este procedimiento NO eliminara el producto")', title="Quitar producto"><i class="icon-minus"></i></a>
									{{-- HTML::link(
										route('admin.catalogs.images.destroy',
											array('catalog' => $catalog->id, 'id' => $product->id)
										), 
										'<i class="icon-trash"></i>',
										array(
											'class' => 'delete info btn btn-inverse',
											'title' => 'Eliminar imagen',
											'onClick' => 'return confirm("¿Esta seguro que desea eliminar la imagen relacionada a este catalogo?")'
										)
									) --}}
								</div>
							</div>
						</article>
						@if(++$i % 4 == 0 && $i > 0)
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
		$("span.spinner").css('display', 'inline');
		//$("#output").css('display','none');
		return true;
	}
	
	function showResponse(response, statusText, xhr, $form){
		if(response.success == false){
			var arr = response.errors;
			$('div.text-error').prepend('<h3>' + response.error + '</h3>');
			$("ul.errors").empty();
			$.each(arr, function(index, value){
				if (value.length != 0){
					$("ul.errors").append('<li>' + value +'</li>');
				}
			});
			//$("#validation-errors").show();
		}
		else{
			var galleryImageSection = $('#productImages');
			galleryImageSection.html(createItem(response));
		}
		$("span.spinner").css('display', 'none');
	}

	function createItem(response){
		var item = '<section class="row-fluid portfolio thumbnails">' +
				'<article data-id="id-' + response.id + '" data-type="javascript html" class="span12">' +
					'<div class="thumbnail hover-pf1">' +
						'<img src="' + response.file + '" alt="' + response.name + '" class="img-rounded">' + 
						'<div class="mask-1"></div>' + 
						'<div class="mask-2"></div>' + 
						'<div class="caption">' + 
							'<h2><a class="title" href="images/' + response.id + '/edit", title="Editar image"><i class="icon-pencil"></i> ' + response.name + '</a></h2>' + 
							'<a class="info btn btn-small btn-inverse" href="images/' + response.id + '/delete" onclick="return confirm(\'¿Esta seguro que desea eliminar la imagen de catálogo?\')", title="Eliminar imagen"><i class="icon-trash"></i></a>' + 
						'</div>' +
					'</div>' +
				'</article>' +
			'</section>';
			return item;
	}
	</script>
@stop