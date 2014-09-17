@extends('admin.layouts.main')

@section('head_title')
	Información
@stop

@section('nav')
	<?php $nav['options'] = array('active_item' => 'Admin'); ?>
	@parent
@stop

@section('breadcrumbs')
	<li><a href="/"><i class="icon-home"></i>Lojuz</a></li>
	<span class="divider">/</span>
	<li class="active"><i class="icon-wrench"></i>Administración</li>
@stop

@section('content')
	<table class="table table-striped table-hover table-bordered">
		<caption><h3>Estadisticas del sitio</h3></caption>
		<thead>
			<tr>
				<th title="Tipo de elemento">Tipo</th>
				<th title="Total de elementos">Total</th>
				<th title="Numero de elementos visibles"># Visibles</th>
				{{--<th title="# de Productos asociados"><i class="icon-list-alt"></i></th>
				<th colspan="3">Acciones</th>--}}
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<a href="{{ route('admin.news.index') }}" title="Ir a Noticias"><i class="icon-bullhorn"></i> Noticias</a>
					</td>
					<td>
						{{ $stats['news']['total'] }}
					</td>
					<td>
						{{ $stats['news']['visible'] }}
					</td>
				</tr>
				<tr>
					<td>
						<a href="{{ route('admin.clients.index') }}" title="Ir a Clientes"><i class="icon-bookmark"></i> Clientes</a>
					</td>
					<td>
						{{ $stats['clients']['total'] }}
					</td>
					<td>
						{{ $stats['clients']['visible'] }}
					</td>
				</tr>
				<tr>
					<td>
						<a href="{{ route('admin.catalogs.index') }}" title="Ir a Catalogos"><i class="icon-briefcase"></i> Catalogos</a>
					</td>
					<td>
						{{ $stats['catalogs']['total'] }}
					</td>
					<td>
						{{ $stats['catalogs']['visible'] }}
					</td>
				</tr>
				<tr>
					<td>
						<a href="{{ route('admin.products.lists') }}" title="Ir a Productos"><i class="icon-list-alt"></i> Productos</a>
					</td>
					<td>
						{{ $stats['products']['total'] }}
					</td>
					<td>
						{{ $stats['products']['visible'] }}
					</td>
				</tr>
				<tr>
					<td>
						<a href="{{ route('admin.galleries.index') }}" title="Ir a Galerias"><i class="icon-th-large"></i> Galerias</a>
					</td>
					<td>
						{{ $stats['galleries']['total'] }}
					</td>
					<td>
						{{ $stats['galleries']['visible'] }}
					</td>
				</tr>
		</tbody>
	</table>
	{{-- Catalogs pagination --}}
	{{-- $catalogs->links() --}}
@stop