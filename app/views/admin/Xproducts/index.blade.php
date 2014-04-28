@extends('admin.products.layouts.main')

@section('title')
	<h3>Productos</h3>
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><i class="icon-folder-open"></i>Productos</li>
@stop

@section('buttons')
	<a href="{{ route('admin.products.create') }}"><button class="btn" title="Crear nuevo producto"><i class="icon-plus"></i> Crear</button></a>
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
	<table class="table table-striped table-hover table-bordered">
		<caption>Lista de productos asignados</caption>
		<thead>
			<tr>
				@foreach(array('id' => '#', 'name' => 'Nombre', 'catalog' => 'Catalogo', 'tags' =>'Etiquetas', 'status' => 'Estatus', 'type' => 'Tipo', 'price' => 'Precio', 'images' => array( 'icon' => 'picture', 'label' => '# de Imagenes' )) as $key => $attribute)
					@if(is_array( $attribute ))
						<th title="{{ $attribute['label'] }}"><i class="icon-{{ $attribute['icon'] }}"></i></th>
					@else
						<th>{{ $attribute }}</th>
					@endif
				@endforeach
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)
				<tr>
					@foreach(array(
						'id' => '#',
						'name' => array( 'label' => 'Nombre', 'link' => route('admin.catalogs.products.show', array($product->catalog_id, $product->id))),
						'catalog' => array( 'label' => 'Catalogo', 'attr' => 'name' ),
						'tags' =>array( 'label' => 'Etiquetas', 'pick' => 3 ),
						'status' => array( 'values' => array( array( 'label' => 'Oculta', 'emph' => 'text-warning' ), array( 'label' => 'Visible', 'emph' => 'text-success' )) ),
						'type' => array( 'values' => array( 'service' => 'Servicio', 'product' => 'Producto')),
						'price' => array( 'label' => 'precio', 'prefix' => '$'),
						'images' => array( 'label' => 'Imagenes', 'stat' => 'count', 'link' => route('admin.products.show', $product->id))
					) as $key => $label)
						<td>
							@if( is_array($label) )
								@if( isset( $label['attr'] ) )
									@if( !empty( $product->$key->$label['attr'] ) )
										{{ HTML::link(route('admin.catalogs.show', $product->$key->id), $product->$key->$label['attr'], array( 'title' => 'Ver catalogo' ) ) }}
									@endif
								@endif

								@if( isset( $label['values'] ) )
									@if( is_array( $label['values'][$product->$key] ) )
										<span class="{{ $label['values'][$product->$key]['emph'] }}">{{ $label['values'][$product->$key]['label'] }}</span>
									@else
										{{ $label['values'][$product->$key] }}
									@endif
								@endif

								@if( isset( $label['link'] ) )
									<a href="{{ $label['link'] }}"@if( isset($label['title']) ) title="{{ $label['title'] }}" @endif>
										@if( isset($label['stat']) )
											{{ $product->$key->$label['stat']() }}
										@else
											{{ $product->$key }}
										@endif
									</a>
								@endif

								@if( isset( $label['prefix'] ) )
									{{ $label['prefix'].$product->$key }}
								@endif

								@if( isset( $label['pick'] ) )
									{{ implode(', ', array_slice(explode(', ', $product->$key), 0, $label['pick'])).( count(explode(', ', $product->$key)) > $label['pick'] ? HTML::link(route('admin.products.show', $product->id), ', ...') : '' )  }}
								@endif
							@else
									{{ $product->$key }}
							@endif
						</td>
					@endforeach
					<td>
						<div class="btn-group">
							<a href="{{ route('admin.catalogs.products.show', array($product->catalog_id, $product->id)) }}"><button class="btn" title="Inspeccionar producto"><i class="icon-eye-open"></i></button></a>

							<a href="{{ route('admin.catalogs.products.edit', array($product->catalog_id, $product->id)) }}"><button class="btn" title="Modificar producto"><i class="icon-pencil"></i></button></a>

							<a class="delete" href="{{ route('admin.catalogs.products.unassign', array($product->catalog_id, $product->id)) }}" onclick="return confirm('¿Esta seguro que desea quitar el producto \'{{ $product->name }}\' del catalogo? Este procedimiento NO eliminara el producto')"><button class="btn" title="Quitar producto"><i class="icon-minus"></i></button></a>

							<a class="delete" href="{{ route('admin.catalogs.products.destroy', array($product->catalog_id, $product->id)) }}" onclick="return confirm('¿Esta seguro que desea eliminar el producto \'{{ $product->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar producto"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Products pagination --}}
	{{ $products->links() }}

	<h3>Productos huerfanos</h3>
	<table class="table table-striped table-hover table-bordered">
		<caption>Productos huerfanos asignables a un catalogo existente</caption>
		<thead>
			<tr>
				@foreach(array('id' => '#', 'name' => 'Nombre', 'catalog' => 'Catalogo', 'tags' =>'Etiquetas', 'status' => 'Estatus', 'type' => 'Tipo', 'price' => 'Precio', 'images' => array( 'icon' => 'picture', 'label' => '# de Imagenes' )) as $key => $attribute)
					@if(is_array( $attribute ))
						<th title="{{ $attribute['label'] }}"><i class="icon-{{ $attribute['icon'] }}"></i></th>
					@else
						<th>{{ $attribute }}</th>
					@endif
				@endforeach
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($orphans as $product)
				<tr>
					@foreach(array(
						'id' => '#',
						'name' => array( 'label' => 'Nombre', 'link' => route('admin.products.show', $product->id) ),
						'catalog' => array( 'label' => 'Catalogo', 'attr' => 'name' ),
						'tags' =>'Etiquetas',
						'status' => array( 'values' => array( array( 'label' => 'Oculta', 'emph' => 'text-warning' ), array( 'label' => 'Visible', 'emph' => 'text-success' )) ),
						'type' => array( 'values' => array( 'service' => 'Servicio', 'product' => 'Producto')),
						'price' => array( 'label' => 'precio', 'prefix' => '$'),
						'images' => array( 'label' => 'Imagenes', 'stat' => 'count', 'link' => route('admin.products.show', $product->id))
						) as $key => $label)
							<td>
								@if( is_array($label) )
									@if( isset( $label['attr'] ) )
										{{ HTML::link(route('admin.products.edit', $product->id), 'Asignar a ...' ) }}
									@endif

									@if( isset( $label['stat'] ) )
										{{ $product->$key->$label['stat']() }}
									@endif

									@if( isset( $label['values'] ) )
										@if( is_array( $label['values'][$product->$key] ) )
											<span class="{{ $label['values'][$product->$key]['emph'] }}">{{ $label['values'][$product->$key]['label'] }}</span>
										@else
											{{ $label['values'][$product->$key] }}
										@endif
									@endif

									@if( isset( $label['link'] ) )
										<a href="{{ $label['link'] }}" @if( isset($label['title']) )title="{{ $label['title'] }}" @endif>
											@if( isset($label['stat']) )
												{{ $product->$key->$label['stat']() }}
											@else
												{{ $product->$key }}
											@endif
										</a>
									@endif

									@if( isset( $label['prefix'] ) )
										{{ $label['prefix'].$product->$key }}
									@endif
								@else
										{{ $product->$key }}
								@endif
							</td>
					@endforeach
					<td>
						<div class="btn-group">
							<a href="{{ route('admin.products.show', $product->id ) }}"><button class="btn" title="Inspeccionar producto"><i class="icon-eye-open"></i></button></a>
							<a href="{{ route('admin.products.edit', $product->id ) }}"><button class="btn" title="Modificar producto"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="{{ route('admin.products.destroy', $product->id ) }}" onclick="return confirm('¿Esta seguro que desea eliminar el producto \'{{ $product->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar producto"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Products pagination --}}
	{{ $orphans->links() }}
@stop