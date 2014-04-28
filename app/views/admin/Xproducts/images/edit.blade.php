@extends('admin.products.layouts.images')

@section('title')
	<h3>Imagen: "{{ $image->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	@if( $product->catalog_id !== null )
		<li><a href="{{ route('admin.catalogs.products.show', array($product->catalog_id, $product->id)) }}"><i class="icon-file"></i>{{ $product->name }}</a></li><span class="divider">/</span>
	@else
		<li><a href="{{ route('admin.products.show', $product->id) }}"><i class="icon-file"></i>{{ $product->name }}</a></li><span class="divider">/</span>
	@endif
	<li><i class="icon-picture"></i>{{ $image->name }}</li><span class="divider">/</span>
	<li class="active"><i class="icon-pencil"></i>Editar</li>
@stop

@section('javascript')
	@parent
	<script src="http://malsup.github.com/jquery.form.js"></script>
@stop

@section('buttons')
	<a href="{{ route('admin.products.edit', $product->id) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de la imagen?')"><button class="btn" title="Agregar nueva imagen"><i class="icon-plus"></i> Agregar</button></a>

	{{--<a href="{{ route('admin.products.images.index', $product->id) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de la imagen?')"><button class="btn" title="Listar imagenes"><i class="icon-list"></i> Listar</button></a>--}}

	{{--<a href="{{ route('admin.products.images.show', array($product->id, $image->id)) }}" onclick="return confirm('¿Esta seguro que desea salir sin guardar los detalles de la imagen?')"><button class="btn" title="Ver esta imagen"><i class="icon-eye-open"></i> Ver</button></a>--}}

	<a class="delete" href="{{ route('admin.products.images.destroy', array($product->id, $image->id)) }}" onclick="return confirm('¿Esta seguro que desea eliminar el imagen \'{{ $image->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar imagen"><i class="icon-trash"></i> Eliminar</button></a>
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
	{{ Form::model($image, array('route' => array('admin.products.images.update', $product->id, $image->id), 'class' => 'af-form', 'id' => 'product-form', 'method' => 'put') ) }}
	<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">
					<div class="span7">
						<h3>Detalles</h3>
					</div>
					<div class="span5">
						<div class="af-inner pull-right">
							<input type="submit" name="submit" class="btn btn-primary" id="product-submit_btn" value="Guardar">
							<a href="{{ route('admin.products.show', $product->id) }}">
								<button type="button" class="btn">Cancel</button>
							</a>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row-fluid">
						<div class="control-group span4">
							<label class="control-label" for="inputCatalog_id">Catalogo</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">@</span>
									{{ Form::text('product_id', $product->name, array('placeholder' => $product->name, 'class' => '', 'id' => 'inputCatalog', 'disabled' => 'disabled')) }}
								</div>
							</div>
						</div>
						<div class="control-group span4">
							<label class="control-label" for="inputName">Nombre</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-font"></i></span>
									{{ Form::text('name', Input::old('name'), array('placeholder' => 'Nombre', 'class' => '', 'id' => 'inputName')) }}
								</div>
							</div>
						</div>
						<div class="control-group span4">
							<label class="control-label" for="inputComment">Descripción</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">''</span>
										{{ Form::textarea('comment', Input::old('comment'), array('placeholder' => 'Descripción de la imagen', 'class' => '', 'id' => 'inputDescription', 'rows' => 3)) }}
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span4">
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
						<br>
					</div>
				</div>
			</div>
	</div>
	{{ Form::close() }}
	<div class="row-fluid">
		<div class="span12">
			<h3>Tamaños</h3>
			<div class="page-inner">
				<div class="row-fluid">
					<div class="span12">
						<h4>Original</h4>
						{{ HTML::image($image->file, $image->name, array('id' => 'original')); }}
					</div>
					<div class="row-fluid">
					<div class="span4">
						<h4>Slide</h4>
						<div id="slide-preview-pane" class="preview-pane">
							<div class="preview-container">
								{{ HTML::image($image->file, $image->name, array('class' => 'img-rounded', 'id' => 'slide')); }}
							</div>
						</div>
					</div>
						{{--<div class="row-fluid" id="largethumb-preview-pane" class="preview-pane">
							<h4>Miniatura Gnd</h4>
							<div class="preview-container">
								{{ HTML::image($image->file, $image->name, array('class' => 'img-rounded', 'id' => 'slide')); }}
							</div>
						</div>
						<div class="row-fluid" id="thumb-preview-pane" class="preview-pane">
							<h4>Miniatura Md</h4>
							<div class="preview-container">
								{{ HTML::image($image->file, $image->name, array('class' => 'img-rounded', 'id' => 'slide')); }}
							</div>
						</div>
						<div class="row-fluid" id="minthumb-preview-pane" class="preview-pane">
							<h4>Miniatura Ch</h4>
							<div class="preview-container">
								{{ HTML::image($image->file, $image->name, array('class' => 'img-rounded', 'id' => 'slide')); }}
							</div>
						</div>--}}
					</div>
				</div>
				{{ Form::model($image, array('route' => array('admin.products.images.update', $product->id, $image->id), 'class' => 'af-form form-horizontal', 'id' => 'product-form', 'method' => 'put') ) }}
					<?php $span = 0; ?>
					@foreach(array('slide' => array( 'title' => 'Slide', 'span' => 7 ), 'largethumb' => array( 'title' => 'Miniatura 
					Gnd', 'span' => 7 ), 'thumb' => array( 'title' => 'Miniatura Md', 'span' => 7 ), 'minithumb' => array( 'title' => 'Miniatura Ch', 'span' => 7 ), ) as $picture => $label)
							@if($span % 12 == 0 && $span == 0)
								<section class="row-fluid">
							@endif
							<div class="span{{ $label['span'] }}">
								{{--<div class="af-outer af-required">
									<div class="af-inner">
										<div class="control-group">
											<label class="control-label" for="inputImage">{{ $label['title'] }}</label>
											<div class="controls">
												{{ Form::file($picture, array('id' => 'inputImageFile')); }}
											</div>
										</div>
									</div>
								</div>--}}
									<?php $span += $label['span']; ?>
									{{--<div class="thumbnail hover-pf1">
										{{ HTML::image($image->file, $image->label, array('class' => 'img-rounded', 'id' => $label['title'])); }}
										{{--<img src="example/latest1.jpg" alt="">--}}
										{{--<div class="mask-1"></div>
										<div class="mask-2"></div>
										<div class="caption">
											<h2><a class="title" href="{{ route('admin.products.show', $product->id) }}", title="{{ $picture }}" target="_black">{{ $label['title'] }}</a></h2>
										</div>
									</div>--}}
								</article>
							</div>
							@if($span % 12 == 0 || $span == 0)
								<?php $span = 0; ?>
								</section>
							@endif
					@endforeach
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop

@section('footer')
	@parent
	<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {

		// Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        boundx,
        boundy,

        // Grab some information about the preview pane
        $slidePreview = $('#slide-preview-pane'),
        /*$largethumbPreview = $('#largethumb-preview-pane'),
        $thumbPreview = $('#thumb-preview-pane'),
        $minithumbPreview = $('#minithumb-preview-pane'),*/

        $slidePcnt = $('#slide-preview-pane .preview-container img'),
        $slidePimg = $('#slide-preview-pane .preview-container'),

        /*$largethumbPcnt = $('#largethumb-preview-pane .preview-container'),
        $largethumbPimg = $('#largethumb-preview-pane .preview-container img'),

        $thumbPcnt = $('#thumb-preview-pane .preview-container'),
        $thumbPimg = $('#thumb-preview-pane .preview-container img'),

        $minithumbPcnt = $('#minithumb-preview-pane .preview-container'),
        $minithumbPimg = $('#minithumb-preview-pane .preview-container img'),*/


        xsize = $slidePcnt.width(),
        ysize = $slidePcnt.height();
    
    console.log('init',[xsize,ysize]);
    $('#original').Jcrop({
      //onChange: updatePreview,
      //onSelect: updatePreview,
      aspectRatio: xsize / ysize
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      //console.log('bounds',[boundx,boundy]);
      // Store the API in the jcrop_api variable
      jcrop_api = this;

      // Move the preview into the jcrop container for css positioning
      //$slidePreview.appendTo(jcrop_api.ui.holder);
    });

    function updatePreview(c)
    {
      if (parseInt(c.w) > 0)
      {
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        $slidePimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
    };




	var ajaxFormOptions = {
			beforeSubmit:  showRequest,
			success:		showResponse,
			dataType: 'json' 
		};
		$('body').delegate('#image-submit_btn','click', function(e){
			$('#image-form').ajaxForm(ajaxFormOptions).submit();
		});
	});

	function showRequest(formData, jqForm, ajaxFormOptions){
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