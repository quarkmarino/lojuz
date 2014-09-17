<?php
/*
|---------------------------------------------
| Usage
|---------------------------------------------
|
|	@section('nav')
|		@include(
|			'widgets.navbar.navbar',
|			[
|				'brand' => ['logo' => '/img/logo.png'],
|				'items' => [
|					'home' => ['label' => 'INICIO', 'url' => '/'],
|					'about' => 'ACERCA DE',
|					'pages' => [
|						'label' => 'PÁGINAS',
|						'items' => [
|							'portfolio' => 'Portfolio',
|							'portfolio-item' => 'Elemento de galería'
|							'coming-soon' => 'Próximamente'
|							'sign-in' => 'Acceso'
|							'backgrounds' => 'Fondos'
|						],
|						'hide' => true			//just define hide  for skiping this group
|					],
|					'features' => 'CARACTERÍSTICAS',
|					'services' => 'SERVICIOS',
|					'pricing' => 'PRECIOS',
|					'contact' => 'CONTACTO',
|					'blog' => 'BLOG'
|				],
|				'options' => ['static' => 'true']
|			]
|		)
|	@show
|
*/
?>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="/"><img src="/images/logo_small.png"></a>
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
					@if( isset( $items ) )
						@foreach( $items as $name => $item )
							@if( isset( $item['items'] ) && !isset( $item['hide'] ) )
								<li class="dropdown" @if( isset( $item['url'] ) ) href="{{ $item['url'] }}" @else href="{{ $name }}" @endif>
									<a @if( isset( $options['active_item'] ) && $options['active_item'] == $name ) class="active" @endif
											class="dropdown-toggle" data-toggle="dropdown">
										{{ $item['label'] }}
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										@foreach( $item['items'] as $subname => $subitem )
											<li><a href="/{{ $name }}/{{ $subname }}">{{ $subitem }}</a></li>
										@endforeach
									</ul>
								</li>
							@else
								<li @if( isset( $options['active_item'] ) && $options['active_item'] == $name ) class="active" @endif>
									<a @if( is_array( $item ) && isset( $item['url'] ) )
												href="/{{ $item['url'] }}">{{ $item['label'] }}
											@else
												href="/{{ $name }}">{{ $item }}
											@endif
									</a>
								</li>
							@endif
						@endforeach
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>