@extends('admin.catalogs.layouts.main')

@section('title')
	<h3>Catalogo: "{{ $catalog->name }}"</h3>
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin.catalogs.index') }}"><i class="icon-folder-open"></i>Catálogos</a></li><span class="divider">/</span>
	<li class="active"><i class="icon-file"></i>{{ $catalog->name }}</li>
	<span class="divider">/</span>
	<li class="active"><a href="{{ route('admin.catalogs.products.index', $catalog->id) }}"><i class="icon-folder-open"></i>Productos</a></li>
@stop

@section('buttons')
	<a href="{{ route('admin.catalogs.create') }}">
		<button class="btn" title="Crear nuevo catalogo"><i class="icon-plus"></i> Crear</button>
	</a>
	<a href="{{ route('admin.catalogs.index') }}">
		<button class="btn" title="Listar catalogos"><i class="icon-list"></i> Listar</button>
	</a>
	<a href="{{ route('admin.catalogs.edit',$catalog->id) }}">
		<button class="btn" title="Modificar este catalogo"><i class="icon-pencil"></i> Editar</button>
	</a>
	<a class="delete" href="{{ route('admin.catalogs.destroy',$catalog->id) }}" onclick="return confirm('¿Esta seguro que desea eliminar el catalogo \'{{ $catalog->name }}\' y todas sus productos relacionadas?')">
		<button class="btn" title="Eliminar catalogo"><i class="icon-trash"></i> Eliminar</button>
	</a>
@stop

@section('content')
	@parent
	<div class="row-fluid">
		<div class="span6">
			<h3>Detalles</h3>
			<div class="page-inner">
				<dl class="dl-horizontal">
					@foreach(array(
						'name' => array( 
							'label' => 'Nombre',
							'link' => route('admin.catalogs.edit', array('id' => $catalog->id)),
						),
						/*'catalog' => array( 
							'label' => 'Catalogo',
							'attr' => 'name',
						),*/
						'tags' =>'Etiquetas',
						'description' =>'Descripción',
						'status' => array(
							'label' => 'Estatus',
							'values' => array(
								array( 'label' => 'Oculta', 'emph' => 'text-warning' ),
								array( 'label' => 'Visible', 'emph' => 'text-success' )
							)
						),
						/*'type' => array(
							'label' => 'Tipo',
							'values' => array(
								'service' => 'Servicio',
								'catalog' => 'Producto'
							)
						),*/
						/*'price' => array( 'label' => 'Precio', 'prefix' => '$'),*/
						'products' => array( 'label' => '# Productos', 'stat' => 'count')
					) as $attr => $label)
							<?php $caption = is_array( $label ) ? $label['label'] : $label ?>
							<dt>{{ $caption }}:</dt>
								<dd>
								@if( is_array($label) )
									{{-- related entity attribute defined by 'attr' --}}
									@if( isset( $label['attr'] ) )
										@if( !empty( $catalog->$attr->$label['attr'] ) )
											{{ HTML::link(route('admin.catalogs.show', array('id' => $catalog->$attr->id)), $catalog->$attr->$label['attr'], array( 'title' => 'Ver catalogo' ) ) }}
										@else
											{{ HTML::link(route('admin.catalogs.edit', array('id' => $catalog->id)), 'Asignar catalogo' ) }}
										@endif
									@endif
									{{-- statistical query for related entity --}}
									@if( isset( $label['stat'] ) )
										@if( $catalog->$attr->$label['stat']() > 0 )
											{{ $catalog->$attr->$label['stat']() }}
										@else
											{{ 'Ninguno' }}
										@endif
									@endif
									{{-- multiple attribute value traduction definition --}}
									@if( isset( $label['values'] ) )
										@if( is_array( $label['values'][$catalog->$attr] ) )
											<span class="{{ $label['values'][$catalog->$attr]['emph'] }}">{{ $label['values'][$catalog->$attr]['label'] }}</span>
										@else
											{{ $label['values'][$catalog->$attr] }}
										@endif
									@endif
									{{-- link definition for attribute --}}
									@if( isset( $label['link'] ) )
										{{ HTML::link($label['link'], $catalog->$attr) }}
									@endif
									{{-- attribute prefix definition  --}}
									@if( isset( $label['prefix'] ) )
										{{ $label['prefix'].$catalog->$attr }}
									@endif

								@else
										{{ $catalog->$attr }}
								@endif
							</dd>
					@endforeach
				</dl>
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
							<a href="{{ route('admin.catalogs.edit', $catalog->id) }}">
								<button class="btn" title="Agregar imagen de catálogo"><i class="icon-plus"></i> Agregar</button>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner" id='productImages'>
				@if($catalog->image !== null)
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
								</div>
							</div>
						</article>
					</section>
				@else
					<p>
						Este catálogo no tiene ninguna imagen de ctalogo asociada.
					</p>
				@endif
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span7">
					<h3><a href="{{ route('admin.catalogs.products.index', $catalog->id) }}">Productos</a></h3>
				</div>
				<div class="span5">
					<div class="btn-toolbar clearfix">
						<div class="btn-group pull-right">
							<a href="{{ route('admin.catalogs.products.create', $catalog->id) }}">
								<button class="btn" title="Crear y agregar un nuevo producto a este catalogo"><i class="icon-plus"></i> Agregar</button>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner" id='catalogProducts'>
				@if($catalog->products->count() > 0)
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
										<h2 class="">
											<a class="title" href="{{ route('admin.catalogs.products.show', array($catalog->id, $product->id)) }}", title="Ver producto"><i class="icon-eye-open"></i> {{ $product->name }}</a>
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
	</div>
@stop