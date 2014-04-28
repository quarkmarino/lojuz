@extends("admin.$class.layouts.main")

@section('head_title')
	@parent
	- Imagenes
@stop

@section('title')
	<h3>Imagen</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route("admin.$class.index") }}"><i class="icon-folder-open"></i>{{ ucfirst(Lang::choice("messages.$class", 2)) }}</a></li>
	<span class="divider">/</span>
	<li><a href="{{ route("admin.$class.show", $owner->id) }}"><i class="icon-file"></i>{{ $owner->name }}</a></li>
	<span class="divider">/</span>
	<li class="active"><i class="icon-folder-open"></i>Imagen</li>
@stop


@section('buttons')
	<a href="{{ route("admin.$class.show", $owner->id) }}"><button class="btn" title="Volver al catálogo"><i class="icon-backward"></i> Volver</button></a>
	{{--<a href="{{ route("admin.$class.images.create', $owner->id) }}"><button class="btn" title="Crear nueva imagen"><i class="icon-plus"></i> Crear</button></a>--}}
@stop

@section('content')
	@parent
	<div class="row-fluid">
		<div class="span6">
			<h3>Detalles</h3>
			<div class="page-inner">
				{{ Form::model($image, array('route' => array("admin.$class.images.store", $owner->id), 'class' => 'af-form form-horizontal', 'id' => 'image-form', 'files' => true) ) }}
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
					@if($owner->image === null)
					@else
						<section class="row-fluid portfolio thumbnails">
							<article data-id="id-{{ $owner->id }}" data-type="javascript html" class="span12">
								<div class="thumbnail hover-pf1">
									{{ HTML::image( $owner->image->slide, $owner->name, array('class' => 'img-rounded', 'title' => $owner->name)); }}
									{{--<img src="example/latest1.jpg" alt="">--}}
									<div class="mask-1"></div>
									<div class="mask-2"></div>
									<div class="caption">
										<h2>
											<a class="title" href="#", title="Ver ownero"><i class="icon-eye-open"></i> Imagen de </a>
										</h2>
										<a class="info btn btn-small btn-inverse" href="{{ route("admin.$class.images.destroy", array($owner->id, $owner->image->id)) }}" onclick='return confirm("¿Esta seguro que desea eliminar la imagen de catálogo?")', title="Quitar imagen"><i class="icon-trash"></i></a>
									</div>
								</div>
							</article>
						</section>
					@endif
				</div>
		</div>
	</div>
@stop