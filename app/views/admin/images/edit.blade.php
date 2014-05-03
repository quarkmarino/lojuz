
@section('head_title')
	@parent
	- Imagenes
@stop

@section('title')
	<h3>Imagen</h3>
@stop

<?php $owner_class = strtolower(basename(strtr(get_class($owner), "\\", "/"))); ?>
<?php $owner_class_plural = str_plural($owner_class); ?>

@section('breadcrumbs')
	@parent
	<li class="active"><i class="icon-picture"></i>Imagen</li>
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
				<br />
				{{ Form::model($image, array('route' => array("admin.$owner_class_plural.images.update", $owner->id, $image->id), 'class' => 'af-form form-horizontal', 'id' => 'image-form', 'files' => true, 'method' => 'put') ) }}
					<div class="af-outer af-required">
						<div class="af-inner">
							<div class="control-group">
								<label class="control-label" for="inputImageName">Nombre</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-font"></i></span>
										{{ Form::text('name', $image->name, array('placeholder' => 'Nombre de imagen', 'class' => 'span12', 'id' => 'inputImageName')) }}
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
											{{ Form::text('comment', $image->comment, array('placeholder' => 'Comentario de imagen', 'class' => 'span12', 'id' => 'inputImageComment')) }}
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
									<input type="submit" class="btn btn-primary pull-right" id="image-submit_btn" value="Guardar">
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
					<div class="btn-toolbar clearfix">
						<div class="btn-group pull-right">
						</div>
					</div>
				</div>
			</div>
				<div class="page-inner" id='productImages'>
					<section class="row-fluid portfolio thumbnails">
						<article data-id="id-{{ $owner->id }}" data-type="javascript html" class="span12">
							<div class="thumbnail hover-pf1">
								{{ HTML::image( $image->slide, $owner->name, array('class' => 'img-rounded', 'title' => $owner->name)); }}
								<div class="mask-1"></div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2>
										<a class="title" href="#", title="Editar imagen"><i class="icon-pencil"></i> Imagen de {{ Lang::choice("messages.$owner_class", 1) }} </a>
									</h2>
									<a class="info btn btn-small btn-inverse" href="{{ route("admin.$owner_class_plural.images.destroy", array($owner->id, $image->id)) }}" onclick='return confirm("¿Esta seguro que desea eliminar la imagen de catálogo?")', title="Quitar imagen"><i class="icon-trash"></i></a>
								</div>
							</div>
						</article>
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