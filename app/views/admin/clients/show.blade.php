@extends('admin.clients.layouts.main')

@section('title')
	<h3>Cliente: "{{ $client->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.clients.index') }}"><i class="icon-folder-open"></i>Clientes</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-file"></i>{{ $client->name }}</li>
	<span class="divider">/</span>
@stop

@section('buttons')
	{{--<a href="{{ route('admin.clients.create') }}">
		<button class="btn" title="Crear nuevo cliente"><i class="icon-plus"></i> Crear</button>
	</a>--}}
	<a href="{{ route('admin.clients.index') }}">
		<button class="btn" title="Volver a catálogos"><i class="icon-backward"></i> Volver</button>
	</a>
	{{--<a href="{{ route('admin.clients.index') }}">
		<button class="btn" title="Listar clientes"><i class="icon-list"></i> Listar</button>
	</a>--}}
	<a href="{{ route('admin.clients.edit',$client->id) }}">
		<button class="btn" title="Modificar este cliente"><i class="icon-pencil"></i> Editar</button>
	</a>
	{{--<a class="delete" href="{{ route('admin.clients.destroy',$client->id) }}" onclick="return confirm('¿Esta seguro que desea eliminar el cliente \'{{ $client->name }}\' y todas sus productos relacionadas?')">
		<button class="btn" title="Eliminar cliente"><i class="icon-trash"></i> Eliminar</button>
	</a>--}}
@stop

@section('content')
	@parent
	<div class="row-fluid">
		<div class="span6">
			<h3>Detalles</h3>
			<div class="page-inner">
				<dl class="dl-horizontal">
					<dt>Nombre:</dt>
						<dd>
							{{ HTML::link( route('admin.clients.edit', array('id' => $client->id)), $client->name) }}
						</dd>
					<dt>A partir de:</dt>
						<dd>
							{{ $client->since }}
						</dd>
					<dt>Comentario:</dt>
						<dd>
							{{ $client->comment }}
						</dd>
					<dt>Estatus:</dt>
						<dd>
							<?php $values = array('label' => array('Oculta', 'Visible'), 'emph' => array('text-warning', 'text-success')); ?>
							<span class="{{ $values['emph'][$client->status] }}">{{ $values['label'][$client->status] }}</span>
						</dd>
				</dl>
			</div>
		</div>
		<div class="span6">
			<div class="row-fluid">
				<div class="span7">
					<h3>Imagen <span class="spinner" style="display: none;"><i class="icon-refresh icon-spin"></i></span></h3>
				</div>
				<div class="span5">
					
				</div>
			</div>
			<div class="page-inner" id='productImages'>
				@if($client->logo !== null)
					<section class="row-fluid portfolio thumbnails">
						<article data-id="id-{{ $client->id }}" data-type="javascript html" class="span12">
							<div class="thumbnail hover-pf1">
								{{ HTML::image( $client->slide, $client->name, array('class' => 'img-rounded', 'title' => $client->name)); }}
								{{--<img src="example/latest1.jpg" alt="">--}}
								<div class="mask-1"></div>
								<div class="mask-2"></div>
								<div class="caption">
									<h2>
										<a class="title" href="{{ route('admin.clients.edit', $client->id) }}", title="Editar imagen"><i class="icon-pencil"></i> {{ $client->name }}</a>
									</h2>
								</div>
							</div>
						</article>
					</section>
				@else
					<p>
						Este cliente no tiene ningun logo asociado.
					</p>
				@endif
			</div>
		</div>
	</div>
	{{--<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span7">
					<h3><a href="{{ route('admin.clients.index', $client->id) }}">Productos</a></h3>
				</div>
				<div class="span5">
					<div class="btn-toolbar clearfix">
						<div class="btn-group pull-right">
							<a href="{{ route('admin.clients.create', $client->id) }}">
								<button class="btn" title="Crear y agregar un nuevo producto a este cliente"><i class="icon-plus"></i> Agregar</button>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner" id='clientProducts'>
				@if($client->products->count() > 0)
					<section class="row-fluid portfolio thumbnails">
						<?php $i = 0; ?>
						@foreach($client->products as $product)
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
									{{--<div class="mask-1"></div>
									<div class="mask-2"></div>
									<div class="caption">
										<h2 class="">
											<a class="title" href="{{ route('admin.clients.show', array($client->id, $product->id)) }}", title="Ver producto"><i class="icon-eye-open"></i> {{ $product->name }}</a>
										</h2>
									</div>
								</div>
							</article>
							@if(++$i % 4 == 0 && $i > 0)
								</section>
								<section class="row-fluid portfolio thumbnails">
							@endif
						@endforeach
					</section>
				@else
					<p>
						Este catálogo no tiene ninguno producto asociado.
					</p>
				@endif
			</div>
		</div>
	</div>--}}
@stop