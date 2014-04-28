@extends('layouts.main')

@section('head_title')
	Inicio
@stop

@section('nav')
	<?php $nav['options'] = array('active_item' => 'home'); ?>
	@parent
@stop

@section('javascript')
	@parent
	<script type="text/javascript" src="js/layerslider.kreaturamedia.jquery.js"></script>
@stop

@section('css')
	@parent
	<link rel="stylesheet" type="text/css" href="css/layerslider.css" >
@stop



@section('content')

<div class="container">

	<div class="row">

		<!-- start: Page section -->
		<section id="page-sidebar" class="span12">

			<div class="page-inner">

				<div class="row-fluid">
				@section('slider')
				<?php
				$slides = array(
				'first' => array(
				'class' => 'ls-layer slide1',
				'background' => 'img/backgrounds/communication_top.png',
				'items' => array(
				array('type' => 'image', 'class' => 'ls-bg', 'style' => '', 'src' => 'example/layerslider/slider-a2.jpg'),
				array('type' => 'image', 'class' => 'ls-s2', 'style' => 'top: 10px; left: 470px; delayin: 0; durationin: 5000; slidedirection: left; easingin: easeOutQuart; delayout: 0; durationout: 1500; slideoutdirection: right; easingout: easeInOutQuint;', 'src' => 'example/layerslider/l14.png'),
				array('type' => 'h2', 'class' => 'ls-s4 ls-head', 'style' => 'top: 70px; left: 70px; delayin : 400; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Totalmente responsiva'),
				array('type' => 'h3', 'class' => 'ls-s4 ls-label', 'style' => 'top: 120px; left: 70px; delayin: 800; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Impresionantes animaciones'),
				array('type' => 'p', 'class' => 'ls-s4 ls-sublabel', 'style' => 'top: 165px; left: 70px; delayin: 1000; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Galeria completamente animada'),
				array('type' => 'p', 'class' => 'ls-s4 ls-sublabel', 'style' => 'top: 165px; left: 70px; delayin: 1000; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => '100% integrada con elementos sociales'),
				array('type' => 'p', 'class' => 'ls-s4 ls-sublabel', 'style' => 'top: 215px; left: 70px; delayin: 1400; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Agradable a la vista'),
				array('type' => 'p', 'class' => 'ls-s4 ls-sublabel', 'style' => 'top: 255px; left: 70px; delayin: 1600; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Interactivo con el usuario'),
				array('type' => 'p', 'class' => 'ls-s4 ls-sublabel', 'style' => '', 'content' => ''),
				)
				),
				'second' => array(
				'class' => 'ls-layer slide2',
				'items' => array(
				array('type' => 'image', 'class' => 'ls-bg', 'style' => '', 'src' => 'example/layerslider/slider-a1.jpg'),

				array('type' => 'image', 'class' => 'ls-s1', 'style' => 'top: 20px; left: 50px; delayin: 0; durationin: 12000; slidedirection: right; easingin: easeOutQuart; delayout: 0; durationout: 1500; slideoutdirection: left; easingout: easeInOutQuint;', 'src' => 'example/layerslider/cl-1.png'),
				array('type' => 'image', 'class' => 'ls-s2', 'style' => 'top: 20px; left: 570px; delayin: 0; durationin: 5000; slidedirection: left; easingin: easeOutQuart; delayout: 0; durationout: 1500; slideoutdirection: right; easingout: easeInOutQuint;', 'src' => 'example/layerslider/l13.png'),
				array('type' => 'image', 'class' => 'ls-s3', 'style' => 'top: 0px; left: -250px; delayin : 0; durationin : 10000; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'src' => 'example/layerslider/cl-2.png'),

				array('type' => 'h2', 'class' => 'ls-s4 ls-head', 'style' => 'top: 70px; left: 70px; delayin : 400; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Su empresa lo vale'),

				array('type' => 'p', 'class' => 'ls-s4 ls-sublabel', 'style' => 'top: 140px; left: 70px; delayin: 800; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Proveemos los mejores productos'),
				array('type' => 'p', 'class' => 'ls-s4 ls-sublabel', 'style' => 'top: 165px; left: 70px; delayin: 1000; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Nuestros empleados estan altamente calificados'),
				array('type' => 'p', 'class' => 'ls-s4 ls-sublabel', 'style' => 'top: 190px; left: 70px; delayin: 1200; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Siempre estamos buscando la perfeccion'),
				array('type' => 'p', 'class' => 'ls-s4 ls-sublabel', 'style' => 'top: 215px; left: 70px; delayin: 1400; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Implementamos los metodos mas inovativos'),
				array('type' => 'a', 'class' => 'ls-s4 ls-label', 'style' => 'top: 255px; left: 70px; delayin: 1600; durationin : 1500; slidedirection: right; easingin : easeOutQuart; delayout: 0; durationout : 1500; slideoutdirection: left; easingout : easeInOutQuint;', 'content' => 'Ver más<i class="icon-double-angle-right"></i>', 'href' => 'about'),
				)
				),
				);
				?>
				@include( 'widgets.slider', array( 'slides' => $slides ) )
				@show
				<!-- end: Slider -->
				</div>

				<div class="sub-inner">

					<hr class="hidden-phone">

					<div class="row-fluid">
						<section class="welcome pull-center">
						<h1>
							Fusce sodales turpis, <span class="text-info">magna metus lobortis</span> justo a viverra!
						</h1>
						<h4>
							Duis mattis placerat lectus, ac suscipit ligula tempus a. Vivamus dictum sem id dui pharetra sit amet vehicula tortor egestas.
						</h4>
						<p>
							<a href="./portfolio.html" class="btn btn-primary">Galeria</a>
							<a href="./services.html" class="btn btn-primary">Our Services</a>
						</p>
						</section>
					</div>

					<hr>

					<h2>{{ HTML::link(route('catalogs.index'), 'Catálogos') }}</h2>
					<div class="row-fluid works">
						@foreach($catalogs as $catalog)
							<div class="span3">
								<a href="portfolio-single" class="thumbnail">
									@if($catalog->image !== null)
										{{ HTML::image($catalog->image->largethumb, $catalog->name) }}
									@else
										{{ HTML::image('images/no-image-largethumb.jpg', $catalog->name) }}
									@endif
									<span class="frame-overlay"></span>
								</a>
								<h4>{{ HTML::link(route('catalogs.show', $catalog->id), $catalog->name) }}</h4>
								<p>{{ $catalog->description }}</p>
							</div>
						@endforeach
					</div>

					<hr>

					<div class="row-fluid highlights">
						<div class="span3">
							<div class="item">
							<div class="icon pull-center"><i class="icon-desktop"></i></div>
							<h3>Capas responcivas</h3>
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo.</p>
							</div>
						</div>
						<div class="span3">
							<div class="item">
							<div class="icon pull-center"><i class="icon-cog"></i></div>
							<h3>HTML5/CSS3</h3>
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo.</p>
							</div>
						</div>
						<div class="span3">
							<div class="item">
							<div class="icon pull-center"><i class="icon-wrench"></i></div>
							<h3>Muchas caracteristicas</h3>
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo.</p>
							</div>
						</div>
						<div class="span3">
							<div class="item">
							<div class="icon pull-center"><i class="icon-shopping-cart"></i></div>
							<h3>Precio asequible</h3>
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo.</p>
							</div>
						</div>
					</div>

					<hr>

					<div class="row-fluid">
					<div class="span3">
					<h4><i class="icon-star"></i> Listo para mobiles</h4>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
					</div>
					<div class="span3">
					<h4><i class="icon-star icon-spin text-warning"></i> Listo para mobiles</h4>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
					</div>
					<div class="span3">
					<h4><i class="icon-star"></i> Listo para mobiles</h4>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
					</div>
					<div class="span3">
					<h4><i class="icon-star"></i> Listo para mobiles</h4>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
					</div>
					</div>
					<div class="row-fluid">
					<div class="span3">
					<h4><i class="icon-star"></i> Listo para mobiles</h4>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
					</div>
					<div class="span3">
					<h4><i class="icon-star"></i> Listo para mobiles</h4>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
					</div>
					<div class="span3">
					<h4><i class="icon-star"></i> Listo para mobiles</h4>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
					</div>
					<div class="span3">
					<h4><i class="icon-star"></i> Listo para mobiles</h4>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
					</div>
					</div>

					<hr>

					<div class="row-fluid">
					<div class="span6">
					<h3>Pestañas</h3>
					<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab1">Pestaña 1</a></li>
					<li class=""><a data-toggle="tab" href="#tab2">Pestaña 2</a></li>
					<li class=""><a data-toggle="tab" href="#tab3">Pestaña 3</a></li>
					</ul>
					<div class="tab-content">
					<div id="tab1" class="tab-pane fade in active">
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra varius posuere. Sed consectetur rutrum egestas. Pellentesque interdum, mi ut dignissim adipiscing, orci enim tempor purus, aliquam tincidunt leo mauris id eros. Suspendisse metus lorem, gravida nec condimentum eu, ultricies nec quam.
					</p>
					</div>
					<div id="tab2" class="tab-pane fade">
					<p>
					Vivamus ac tortor vitae augue rhoncus fermentum. Nam orci eros, pulvinar a tincidunt quis, porttitor sit amet urna. Vivamus vitae risus nisl. Morbi quis urna nec dolor vestibulum consequat vitae sit amet mi. Aenean eleifend lacus nisi. Suspendisse metus lorem, gravida nec condimentum eu, ultricies nec quam.
					</p>
					</div>
					<div id="tab3" class="tab-pane fade">
					<p>
					Aliquam viverra varius posuere. Sed consectetur rutrum egestas. Pellentesque interdum, mi ut dignissim adipiscing, orci enim tempor purus, aliquam tincidunt leo mauris id eros. Suspendisse metus lorem, gravida nec condimentum eu, ultricies nec quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					</p>
					</div>
					</div>
					</div>
					<div class="span6">
					<h3>Testimonios de clientes</h3>
					<div id="myCarousel" class="carousel slide testimonials">
					<!-- Carousel items -->
					<div class="carousel-inner">
					<div class="active item">
					<div class="testimonial">
					<div class="content">
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra varius posuere. Sed consectetur rutrum egestas. Pellentesque interdum, mi ut dignissim adipiscing, orci enim tempor purus, aliquam tincidunt leo mauris id eros.
					</p>
					<span class="quote-arrow"></span>
					</div>
					<div class="author"><p><i class="icon-user"></i> Julio</p></div>
					<div class="author-add"><p>Director de proyecto, Compañia</p></div>
					</div>
					</div>
					<div class="item">
					<div class="testimonial">
					<div class="content">
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra varius posuere. Sed consectetur rutrum egestas. Pellentesque interdum, mi ut dignissim adipiscing, orci enim tempor purus, aliquam tincidunt leo mauris id eros.
					</p>
					<span class="quote-arrow"></span>
					</div>
					<div class="author"><p><i class="icon-user"></i> Augusto</p></div>
					<div class="author-add"><p>Gerente general, Compañia</p></div>
					</div>
					</div>
					<div class="item">
					<div class="testimonial">
					<div class="content">
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra varius posuere. Sed consectetur rutrum egestas. Pellentesque interdum, mi ut dignissim adipiscing, orci enim tempor purus, aliquam tincidunt leo mauris id eros.
					</p>
					<span class="quote-arrow"></span>
					</div>
					<div class="author"><p><i class="icon-user"></i> Abril</p></div>
					<div class="author-add"><p>Diseñadora, Compañia</p></div>
					</div>
					</div>
					</div>
					<!-- Carousel nav -->
					<a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="icon-double-angle-left"></i></a>
					<a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="icon-double-angle-right"></i></a>
					</div>
					</div>
					</div>
				</div>
			</div>

		</section>
		<!-- end: Page section -->

	</div>

</div>
@stop