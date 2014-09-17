@extends('admin.news.layouts.main')

@section('title')
	<h3>Noticia: "{{ $news_item->title }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.news.index') }}"><i class="icon-folder-open"></i>Noticias</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-file"></i>{{ $news_item->title }}</li>
	<span class="divider">/</span>
@stop

@section('buttons')
	{{--<a href="{{ route('admin.news.create') }}">
		<button class="btn" title="Crear nuevo cliente"><i class="icon-plus"></i> Crear</button>
	</a>--}}
	<a href="{{ route('admin.news.index') }}">
		<button class="btn" title="Volver a catálogos"><i class="icon-backward"></i> Volver</button>
	</a>
	{{--<a href="{{ route('admin.news.index') }}">
		<button class="btn" title="Listar clientes"><i class="icon-list"></i> Listar</button>
	</a>--}}
	<a href="{{ route('admin.news.edit',$news_item->id) }}">
		<button class="btn" title="Modificar este cliente"><i class="icon-pencil"></i> Editar</button>
	</a>
	{{--<a class="delete" href="{{ route('admin.news.destroy',$news_item->id) }}" onclick="return confirm('¿Esta seguro que desea eliminar el cliente \'{{ $news_item->title }}\' y todas sus productos relacionadas?')">
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
					<dt>Titulo:</dt>
						<dd>
							{{ HTML::link( route('admin.news.edit', array('id' => $news_item->id)), $news_item->title) }}
						</dd>
					<dt>Mensaje:</dt>
						<dd>
							{{ $news_item->message }}
						</dd>
					<dt>Estatus:</dt>
						<dd>
							<?php $values = array('label' => array('Oculta', 'Visible'), 'emph' => array('text-warning', 'text-success')); ?>
							<span class="{{ $values['emph'][$news_item->status] }}">{{ $values['label'][$news_item->status] }}</span>
						</dd>
				</dl>
			</div>
		</div>
		<div class="span6">
			<div class="row-fluid">
				<div class="span7">
					<h3>Producto Asociado</h3>
				</div>
				<div class="span5">
					
				</div>
			</div>
			<div class="page-inner" id='productImages'>
				@if($news_item->product !== null)
					<dl class="dl-horizontal">
						<dt>Nombre:</dt>
							<dd>
								{{ HTML::link( route('admin.catalogs.products.edit', array($news_item->product->catalog_id, $news_item->product_id)), $news_item->product->name) }}
							</dd>
						<dt>Catálogo:</dt>
							<dd>
								{{ HTML::link(route('admin.catalogs.show', array('id' => $news_item->product->catalog_id)), $news_item->product->catalog->name, array( 'title' => 'Ver catálogo' ) ) }}
							</dd>
						<dt>Etiquetas:</dt>
							<dd>
								{{ $news_item->product->tags }}
							</dd>
						<dt>Estatus:</dt>
							<dd>
								<?php $values = array('label' => array('Oculta', 'Visible'), 'emph' => array('text-warning', 'text-success')); ?>
								<span class="{{ $values['emph'][$news_item->product->status] }}">{{ $values['label'][$news_item->product->status] }}</span>
							</dd>
						<dt>Tipo:</dt>
							<dd>
								<?php $values = array('service' => 'Servicio','product' => 'Producto'); ?>
								{{ $values[$news_item->product->type] }}
							</dd>
						<dt>Precio:</dt>
							<dd>
								${{ $news_item->product->price }}
							</dd>
						<dt>Imagenes:</dt>
							<dd>
								@if( $news_item->product->images->count() > 0 )
									{{ $news_item->product->images->count() }}
								@else
									{{ 'Ninguna' }}
								@endif
							</dd>
					</dl>
				@else
					<p>
						Esta noticia no tiene ningun producto asociado.
					</p>
				@endif
			</div>
		</div>
	</div>
	{{--<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span7">
					<h3><a href="{{ route('admin.news.index', $news_item->id) }}">Productos</a></h3>
				</div>
				<div class="span5">
					<div class="btn-toolbar clearfix">
						<div class="btn-group pull-right">
							<a href="{{ route('admin.news.create', $news_item->id) }}">
								<button class="btn" title="Crear y agregar un nuevo producto a este cliente"><i class="icon-plus"></i> Agregar</button>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner" id='clientProducts'>
				@if($news_item->products->count() > 0)
					<section class="row-fluid portfolio thumbnails">
						<?php $i = 0; ?>
						@foreach($news_item->products as $news_item->product)
							<article data-id="id-{{ $news_item->product->id }}" data-type="javascript html" class="span3">
								<div class="thumbnail hover-pf1">
									@if($news_item->product->images()->first() !== null)
										<?php $image = $news_item->product->images()->first()->toArray(); ?>
										<?php $image = $image['largethumb']; ?>
									@else
										<?php $image = 'images/no-image-largethumb.jpg'; ?>
									@endif
									{{ HTML::image( $image, $news_item->product->name, array('class' => 'img-rounded', 'title' => $news_item->product->name)); }}
									{{--<img src="example/latest1.jpg" alt="">--}}
									{{--<div class="mask-1"></div>
									<div class="mask-2"></div>
									<div class="caption">
										<h2 class="">
											<a class="title" href="{{ route('admin.news.show', array($news_item->id, $news_item->product->id)) }}", title="Ver producto"><i class="icon-eye-open"></i> {{ $news_item->product->name }}</a>
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