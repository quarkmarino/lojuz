@extends('layouts.main')

@section('head_title')
    Información
@stop

@section('nav')
    <?php $nav['options'] = array('active_item' => 'about'); ?>
    @parent
@stop

@section('content')

    <div class="container">
        <!-- start: Page header / Breadcrumbs -->
        <section class="breadcrumbs">
            <div class="page-header">
                <h1>Información<small></small></h1>
            </div>
            <div class="breadcrumbs">
                Usted se encuentra aquí: <a href="/">Inicio</a><i class="icon-angle-right "></i>Información
            </div>
        </section>
        <!-- end: Page header / Breadcrumbs -->

        <div class="row">

            <!-- start: Page section -->
            <section id="page-sidebar" class="span12">
                <div class="page-inner">
                    <div class="row-fluid">
                        <div class="pull-center">
                            <h3>Qui cu verear facer antiopam At mea malorum epicuri <a href="#">accumsan Persi</a> deleniti sapientem no vel, nec nobis equidem et.</h3>
                        </div>
                    </div>

                    <hr>

                    <div class="sub-inner">

                        <div class="row-fluid">

                            <div class="span6">
                                <h3>Misión</h3>
                                <p>Ser la solución  a las necesidades de uniformidad para nuestros clientes, fabricando uniformes y ropa de trabajo bajo los estándares de calidad a precio competitivo  con un excelente servicio responsable.</p>
                            </div>

                            <div class="span6">
                                <h3>Visión</h3>
                                <p>Ser una marca líder y confiable para nuestros clientes.</p>
                            </div>

                            {{-- <div class="span4">
                                <h3>Valores</h3>
                                <p>Sanctus sea sed takimata ut vero voluptua. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                                <p>Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At vero eos et accusam et justo duo dolores et ea rebum.</p>

                            </div> --}}

                        </div>

                        <hr>

                        <div class="row-fluid">
                            <h3>¿Quienes somos?</h3>
                            <p>
                                Somos una empresa dedicada a la fabricación de uniformes escolares, deportivos y empresariales.
                            </p>
                            <p>
                                La prioridad es ofrecerle productos de gran calidad confort y durabilidad para el desarrollo óptimo en las actividades que usted desempeña.
                            </p>
                            <p>
                                Lo anterior lo hemos logrado en base a nuestra experiencia de más de quince años en el ramo y de utilizar para la confección de nuestros uniformes las mejores telas disponibles en el mercado, lo que se traduce en larga vida para la prenda.
                            </p>
                        </div>
                    </div>

                    {{--<div class="row-fluid member-info">
                        <div class="span4">
                            <div class="thumbnail">
                                <img alt="" src="example/team1.jpg"/>
                                <div class="caption">
                                    <h3 class="member-name">Abril</h3>
                                    <p class="member-possition">Gerente general</p>
                                    <p class="member-social"><a href="#"><i class="icon-facebook-sign"></i></a><a href="#"><i class="icon-twitter-sign"></i></a><a href="#"><i class="icon-envelope"></i></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="thumbnail">
                                <img alt="" src="example/team2.jpg"/>
                                <div class="caption">
                                    <h3 class="member-name">Violeta</h3>
                                    <p class="member-possition">Director ejecutivo</p>
                                    <p class="member-social"><a href="#"><i class="icon-facebook-sign"></i></a><a href="#"><i class="icon-twitter-sign"></i></a><a href="#"><i class="icon-envelope"></i></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="thumbnail">
                                <img alt="" src="example/team3.jpg"/>
                                <div class="caption">
                                    <h3 class="member-name">Rocío</h3>
                                    <p class="member-possition">Administrador Principal</p>
                                    <p class="member-social"><a href="#"><i class="icon-facebook-sign"></i></a><a href="#"><i class="icon-twitter-sign"></i></a><a href="#"><i class="icon-envelope"></i></a></p>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </section>
            <!-- end: Page section -->
        </div>
    </div>
@stop