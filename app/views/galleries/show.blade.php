@extends('layouts.main')

@section('head_title')
	{{ $gallery->name }}
@stop

@section('nav')
	<?php $nav['options'] = array('active_item' => 'galleries'); ?>
	@parent
@stop

@section('content')
<!-- start: Container -->
<div class="container">

	<!-- start: Page header / Breadcrumbs -->
	<section class="breadcrumbs">
		<div class="page-header">
			<h1>Galerias<small></small></h1>
		</div>
		<div class="breadcrumbs">
			Usted se encuentra aquí: <a href="/">Inicio</a><i class="icon-angle-right "></i>{{ HTML::link( route( 'galleries.index' ), 'Galerias' ) }}<i class="icon-angle-right "></i>{{ $gallery->name }}
		</div>
	</section>
	<!-- end: Page header / Breadcrumbs -->

	<div class="row">

		<!-- start: Page section -->
		<section id="page-sidebar" class="span12">

			<!-- start: Filter-->
			<h3>Filtrar</h3>
			<div class="row-fluid">
				<div class="span12">
					<ul id="filtrable" class="clearfix">
						<li class="current all"><a href="#all">Todos</a></li>
						@foreach($gallery->images()->whereStatus(1)->get() as $image)
							@foreach(explode(', ', $image->tags) as $tag)
								@if( !isset($used_tags[$tag]) )
									<li class="{{ strtolower($tag) }}"><a href="#{{ strtolower($tag) }}">{{ str_replace('_', ' ', $tag) }}</a></li>
								@endif
								<?php $used_tags[$tag] = true ?>
							@endforeach
						@endforeach
					</ul>
				</div>
			</div>
		</section>
			<!-- end: Filter-->
	</div>

	<!-- start: Portfolio -->
	<section class="row filtrable portfolio thumbnails">
		{{--dd($gallery->images())--}}
		@foreach($gallery->images()->whereStatus(1)->get() as $image)
			<article data-id="id-{{ $image->id }}" data-type="{{ implode(' ', explode(', ', strtolower( $image->tags ) ) ) }}" class="span3">
				<div class="thumbnail hover-pf1">
					@if($image !== null)
						<?php $picture = $image->largethumb; ?>
						{{ HTML::image($picture, $image->name, array('title' => $image->name)) }}
						<div class="mask-1"></div>
						<div class="mask-2"></div>
						<div class="caption">
							<br />
							<br />
							<h2 class="title">
								{{--<a class="fancybox" rel="group" href="big_image_1.jpg"><img src="small_image_1.jpg" alt="" /></a>--}}
								{{ HTML::link($image->file, $image->name, array('class' => 'fancybox btn btn-inverse', 'rel' => 'group', 'title' => $image->comment)) }}
							</h2>
						</div>
					@endif
				</div>
			</article>
		@endforeach

	</section>
	<!-- end: Portfolio -->

</div>
<!-- end: Container -->
@stop

@section('footer')
	@parent
	<script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox({
				helpers : {
					title: {
						type: 'inside'
					}
				}
			});
		});
	</script>
@stop