@extends('admin.news.layouts.main')

@section('title')
	<h3>Noticias</h3>
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><i class="icon-folder-open"></i>Noticias</li>
@stop

@section('buttons')
	<a href="news/create"><button class="btn" title="Crear nuevo noticia"><i class="icon-plus"></i> Crear</button></a>
@stop

@section('content')
	@parent
	<table class="table table-striped table-hover table-bordered">
		<caption>Lista de Noticias</caption>
		<thead>
			<tr>
				<th title="#">id</th>
				<th title="Titulo de la noticia">Titulo</th>
				<th title="Visibilidad de la noticia">Estatus</th>
				<th title="Producto relacionado"><i class="icon-list-alt"></i></th>
				<th colspan="2">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($news as $news_item)
				<tr>
					<td>
						{{ $news_item->id }}
					</td>
					<td>
						<a href="{{ route('admin.news.show', $news_item->id) }}" title="Ver Noticia">
							{{ $news_item->title }}
						</a>
					</td>
					<td>
						<?php $values = array(
							array( 'label' => 'Oculta', 'emph' => 'text-warning' ),
							array( 'label' => 'Visible', 'emph' => 'text-success' )
						) ?>
						<span class="{{ $values[$news_item->status]['emph'] }}">{{ $values[$news_item->status]['label'] }}</span>
					</td>
					<td>
						@if( !empty( $news_item->product->name ) )
							{{ HTML::link(route('admin.catalogs.products.show', array($news_item->product->catalog_id, $news_item->product_id)), $news_item->product->name, array( 'title' => 'Ver producto' ) ) }}
						@else
							{{ HTML::link(route('admin.news.edit', array('id' => $news_item->id)), 'Asignar producto' ) }}
						@endif
					</td>
					<td>
						<div class="btn-group">
							<a href="news/{{ $news_item->id }}"><button class="btn" title="Inspeccionar noticias"><i class="icon-eye-open"></i></button></a>
							<a href="news/{{ $news_item->id }}/edit"><button class="btn" title="Modificar noticias"><i class="icon-pencil"></i></button></a>
							<a class="delete" href="news/{{ $news_item->id }}/delete" onclick="return confirm('¿Esta seguro que desea eliminar el noticias \'{{ $news_item->name }}\' y todas sus imagenes relacionadas?')"><button class="btn" title="Eliminar noticias"><i class="icon-trash"></i></button></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- Catalogs pagination --}}
	{{ $news->links() }}
@stop

{{--@section('javascript')
	@parent
	<script type="text/javascript">
		$(document).ready(function(){			
			$(".delete").on('click', function(event) {
				event.preventDefault();
				$.ajax({
					url: 'news/' + $(this).data('clients_id'),
					type: 'DELETE',
					//data: $("#delete").serializeArray(),
					success: function(data) { $("#results").html(data); }
				}); 
			});
		});
	</script>
@stop--}}