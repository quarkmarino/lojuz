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
            <h1>404<small>/ (Pagina no encontrada)</small></h1>
        </div>
        <div class="breadcrumbs">
            Usted se encuentra aquí: <a href="/">Inicio</a><i class="icon-angle-right "></i>404 (Pagina no encontrada)
        </div>
    </section>
    <!-- end: Page header / Breadcrumbs -->

    <div class="row">

        <!-- start: Page section -->
        <section id="page-sidebar" class="span12">

            <div class="page-inner">
                <div class="hero-unit last pull-center">
                    <div class="row-fluid">
                        <h2>Oh oh! <br/>404: Pagina no encontrada</h2>
                        <p>
                            Lo sentimos, pero la pagina que estas buscando no ha sido encontrada.<br/>
                            Intenta corrigiendo la dirección URL de algun error e intentalo de nuevo.
                        </p>
                        {{--<div class="spacer"></div>--}}

                        {{--<p>search for something else</p>
                        <!-- start: Search widget -->
                        <section class="widget search">
                            <div class="wrapper clearfix">
                                <form id="search" class="input-append">
                                    <input class="span12" id="appendedInputButton" type="text" placeholder="Search" />
                                    <input class="btn search-bt" type="submit" name="submit" value="" />
                                </form>
                            </div>
                        </section>
                        <!-- end: Search widget -->--}}

                        <p>- ó -</p>
                        <p><a class="btn btn-large btn-warning" href="/">Ve a la pagina de inicio</a></p>
                    </div>
                </div>
            </div>
            <!-- start: posts-->
            <!-- end: posts-->

        </section>
        <!-- end: Page section -->

    </div>
</div>
@stop