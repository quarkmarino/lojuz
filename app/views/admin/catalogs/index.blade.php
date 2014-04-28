@extends('admin.catalogs.layouts.main')

@section('title')
	<h3>Catalogos</h3>
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><i class="icon-folder-open"></i>Catálogos</li>
@stop

@section('buttons')
	<a href="catalogs/create"><button class="btn" title="Crear nuevo catalogo"><i class="icon-plus"></i> Crear</button></a>
@stop

@section('content')
	@parent
	<table class="table table-striped table-hover table-bordered">
		{{-- <caption>Lista de Catalogos</caption> --}}
		<thead>
			<tr>
				@foreach(array('id' => '#', 'name' => 'Nombre', 'tags' =>'Etiquetas', 'status' => 'Estatus', /*'description' =>'Descripción',*/ 'products' => array( 'icon' => 'list-alt', 'label' => '# de Productos' )) as $key => $attribute)
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
			@foreach($catalogs as $catalog)
				<tr>
					@foreach(array(
						'id' => '#',
						'name' => array( 'label' => 'Nombre', 'link' => route('admin.catalogs.show', $catalog->id), 'title' => 'Ver Catálogo' ),
						'tags' => array( 'label' => 'Etiquetas', 'pick' => 3 ),
						'status' => array( 'values' => array( array( 'label' => 'Oculta', 'emph' => 'text-warning' ), array( 'label' => 'Visible', 'emph' => 'text-success' )) ),
						//'description' =>'Descripción',
						'products' => array( 'label' => 'Productos', 'stat' => 'count', 'link' => route('admin.catalogs.products.index', $catalog->id), 'title' => 'Ver Productos' )
						) as $key => $label)
							<td>
								@if( is_array($label) )
									{{--@if( isset( $label['attr'] ) )
										@if( !empty( $catalog->$key->$label['attr'] ) )
											{{ HTML::link(route('admin.catalogs.show', array('id' => $catalog->$key->id)), $catalog->$key->$label['attr'], array( 'title' => 'Ver catalogo' ) ) }}
										@else
											{{ HTML::link(route('admin.catalogs.edit', array('id' => $catalog->id)), 'Asignar catalogo' ) }}
										@endif
									@endif--}}

									@if( isset( $label['values'] ) )
										@if( is_array( $label['values'][$catalog->$key] ) )
											<span class="{{ $label['values'][$catalog->$key]['emph'] }}">{{ $label['values'][$catalog->$key]['label'] }}</span>
										@else
											{{ $label['values'][$catalog->$key] }}
										@endif
									@endif

									@if( isset( $label['link'] ) )
										<a href="{{ $label['link'] }}" @if( isset($label['title']) )title="{{ $label['title'] }}" @endif>
											@if( isset($label['stat']) )
												{{ $catalog->$key->$label['stat']() }}
											@else
												{{ $catalog->$key }}
											@endif
										</a>
									@endif

									@if( isset( $label['prefix'] ) )
										{{ $label['prefix'].$catalog->$key }}
									@endif

									@if( isset( $label['pick'] ) )
										{{ implode(', ', array_slice(explode(', ', $catalog->$key), 0, $label['pick'])).( count(explode(', ', $catalog->$key)) > $label['pick'] ? HTML::link(route('admin.catalogs.show', $catalog->id), ', ...') : '' )  }}
									@endif
								@else
										{{ $catalog->$key }}
								@endif
							</td>
					@endforeach
					<td>
						<div class="btn-group pull-right">
							<a href="catalogs/{{ $catalog->id }}"><button class="btn" title="Inspeccionar catalogos"><i class="icon-eye-open"></i></button></a>
							<a href="catalogs/{{ $catalog->id }}/edit"><button class="btn" title="Modificar catalogos"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="catalogs/{{ $catalog->id }}/delete" onclick="return confirm('¿Esta seguro que desea eliminar el catalogos \'{{ $catalog->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar catalogos"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Catalogs pagination --}}
	{{ $catalogs->links() }}
@stop

{{--@section('javascript')
	@parent
	<script type="text/javascript">
		$(document).ready(function(){			
			$(".delete").on('click', function(event) {
				event.preventDefault();
				$.ajax({
					url: 'catalogs/' + $(this).data('catalogs_id'),
					type: 'DELETE',
					//data: $("#delete").serializeArray(),
					success: function(data) { $("#results").html(data); }
				}); 
			});
		});
	</script>
@stop--}}