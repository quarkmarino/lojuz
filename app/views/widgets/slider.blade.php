<?php
/*
|---------------------------------------------
| Usage
|---------------------------------------------
|
|	@section('slider')
|		@include(
|			'widgets.slider',
|			[
|				'slides' => [
|					'first' => [
|						'class' => 'ls-layer slide1',
|						'background' => 'img/backgrounds/communication_top.png',
|						'items' => [
|							'image' => ['class' => 'ls-bg', 'style' => '', 'src' => 'example/layerslider/slider-a2.jpg'],
|							'image' => ['class' => 'ls-s2', 'style' => 'top: 10px; left: 470px; delayin: 0; durationin: 5000; slidedirection: left; easingin: easeOutQuart; delayout: 0; durationout: 1500; slideoutdirection: right; easingout: easeInOutQuint;', 'image' => 'example/layerslider/l14.png'],
|							'h2' => ['class' => 'ls-s4 ls-head', 'style' => 'top: 70px; left: 70px; delayin : 400; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Totalmente responsiva'],
|							'h3' => ['class' => 'ls-s4 ls-label', 'style' => 'top: 120px; left: 70px; delayin: 800; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Impresionantes animaciones'],
|							'p' => ['class' => 'ls-s4 ls-sublabel', 'style' => 'top: 165px; left: 70px; delayin: 1000; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Galeria completamente animada'],
|							'p' => ['class' => 'ls-s4 ls-sublabel', 'style' => 'top: 165px; left: 70px; delayin: 1000; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => '100% integrada con elementos sociales'],
|							'p' => ['class' => 'ls-s4 ls-sublabel', 'style' => 'top: 215px; left: 70px; delayin: 1400; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Agradable a la vista'],
|							'p' => ['class' => 'ls-s4 ls-sublabel', 'style' => 'top: 255px; left: 70px; delayin: 1600; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Interactivo con el usuario'],
|							'p' => ['class' => 'ls-s4 ls-sublabel', 'style' => '', 'content' => ''],
|						]
|					],
|					'second' => [
|						'class' => 'ls-layer slide2',
|						'items' => [
|							'image' => ['class' => 'ls-bg', 'style' => '', 'src' => 'example/layerslider/slider-a1.jpg'],

|							'image' => ['class' => 'ls-s1', 'style' => 'top: 20px; left: 50px; delayin: 0; durationin: 12000; slidedirection: right; easingin: easeOutQuart; delayout: 0; durationout: 1500; slideoutdirection: left; easingout: easeInOutQuint;', 'image' => 'example/layerslider/cl-1.png'],
|							'image' => ['class' => 'ls-s2', 'style' => 'top: 20px; left: 570px; delayin: 0; durationin: 5000; slidedirection: left; easingin: easeOutQuart; delayout: 0; durationout: 1500; slideoutdirection: right; easingout: easeInOutQuint;', 'image' => 'example/layerslider/l13.png'],
|							'image' => ['class' => 'ls-s3', 'style' => 'top: 0px; left: -250px; delayin : 0; durationin : 10000; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'image' => 'example/layerslider/cl-2.png'],

|							'h2' => ['class' => 'ls-s4 ls-head', 'style' => 'top: 70px; left: 70px; delayin : 400; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Su empresa lo vale'],

|							'p' => ['class' => 'ls-s4 ls-sublabel', 'style' => 'top: 140px; left: 70px; delayin: 800; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Proveemos los mejores productos'],
|							'p' => ['class' => 'ls-s4 ls-sublabel', 'style' => 'top: 165px; left: 70px; delayin: 1000; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Nuestros empleados estan altamente calificados'],
|							'p' => ['class' => 'ls-s4 ls-sublabel', 'style' => 'top: 190px; left: 70px; delayin: 1200; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Siempre estamos buscando la perfeccion'],
|							'p' => ['class' => 'ls-s4 ls-sublabel', 'style' => 'top: 215px; left: 70px; delayin: 1400; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Implementamos los metodos mas inovativos'],
|							'a' => ['class' => 'ls-s4 ls-label', 'style' => 'top: 255px; left: 70px; delayin: 1600; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Ver más<i class="icon-double-angle-right"></i>', 'href' => 'about'],
|						]
|					],
|				]
|			]
|		)
|	@show
|
*/

?>

<!-- start: Slider -->

<!-- 
	Each slide is composed by <img> and .info
	- .info's position is customized with css in index.css
	- each <img> parallax effect is declared by the following params inside its class:

	example: class="asset left-472 sp600 t120 z3"
	left-472 means left: -472px from the center
	sp600 is speed transition
	t120 is top to 120px
	z3 is z-index to 3
	Note: Maintain this order of params

	For the backgrounds, you can combine from the bgs folder :D
-->

<section id="slider" class="hidden-phone">
	<div id="layerslider-container">
		<div id="layerslider" style="width: 960px; height: 330px;">
			@foreach( $slides as $id => $slide )
				<div class="{{ $slide['class'] }}">
					@foreach( $slide['items'] as $item )
						@if( $item['type'] == 'image' )
							<img class="{{ $item['class'] }}" style="{{ $item['style'] }}" src="{{ $item['src'] }}" />
						@else
							<{{ $item['type'] }} class="{{ $item['class'] }}" style="{{ $item['style'] }}" />
								{{ $item['content'] }}
							</{{ $item['type'] }}>
						@endif
					@endforeach
				</div>
			@endforeach
		</div>
	</div>
</section>