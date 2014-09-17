@extends('layouts.main')

@section('head_title')
    Contacto
@stop

@section('nav')
    <?php $nav['options'] = array('active_item' => 'contact'); ?>
    @parent
@stop

@section('content')

    <!-- start: Container -->
<div class="container">

    <!-- start: Page header / Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="page-header">
            <h1>Contactenos<small></small></h1>
        </div>
        <div class="breadcrumbs">
            Usted se encuentra aquí: <a href="#">Inicio</a><i class="icon-angle-right "></i>Contactenos
        </div>
    </section>
    <!-- end: Page header / Breadcrumbs -->

    <div class="row">

        <!-- start: Page section -->
        <section id="page-sidebar" class="span12">

            <div class="page-inner">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="row-fluid">
                            <strong>Matriz</strong><br>
                            <div class="gmap">
                                <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.mx/maps?cbll=17.16175,-96.785613&amp;layer=c&amp;panoid=yHeFBzbxGBrvKLqJ2gjjkw&amp;cbp=12,56.95,,1,1.82&amp;ie=UTF8&amp;ll=17.16175,-96.785613&amp;spn=0.298513,0.506058&amp;t=m&amp;z=12&amp;source=embed&amp;output=svembed"></iframe>
                            </div>
                            <div class="span7">
                                <address>
                                    {{--https://www.google.com.mx/maps/@17.16175,-96.785613,3a,24.1y,56.95h,88.18t/data=!3m4!1e1!3m2!1syHeFBzbxGBrvKLqJ2gjjkw!2e0--}}
                                    <ul class="icons">
                                      <li><i class="icon-map-marker"></i>Carretera Internacional Km 11<br />San Sebastian Etla, Oaxaca.</li>
                                      <li><i class="icon-phone"></i> (951) 521 33 33</li>
                                      <li><i class="icon-"><img src="images/whatsapp-14px.png" style="margin-left: -8px; margin-top: -6px"></i> (951) 199 66 66</li>
                                    </ul>
                                </address>
                            </div>
                            <div class="span4 pull-right">
                                <ul class="icons">
                                    <li><i class="icon-envelope"></i><a href="mailto:matriz@lojuz.com">matriz@lojuz.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="row-fluid">
                            <strong>C.U.</strong><br>
                            <div class="gmap">
                                <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?cbll=17.048958,-96.713767&amp;layer=c&amp;panoid=jFN-LvIr8OctJGJ0s9ASAQ&amp;cbp=12,251.72,,1,3.83&amp;ie=UTF8&amp;ll=17.048958,-96.713767&amp;spn=0.298694,0.506058&amp;t=m&amp;z=12&amp;source=embed&amp;output=svembed"></iframe>
                            </div>
                            <div class="span7">
                                <address>
                                    <ul class="icons">
                                        <li><i class="icon-map-marker"></i>
                                            Av. Universidad #406, Centro, Oaxaca
                                        </li>
                                        <li><i class="icon-phone"></i> (951) 516 99 21</li>
                                        <li><i class="icon-"><img src="images/whatsapp-14px.png" style="margin-left: -8px; margin-top: -6px"></i> (951) 190 66 66</li>
                                    </ul>
                                </address>
                            </div>
                            <div class="span4 pull-right">
                                <ul class="icons">
                                    <li><i class="icon-envelope"></i><a href="mailto:cu@lojuz.com">cu@lojuz.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <div class="row-fluid">
                            <strong>Reforma</strong><br>
                            <div class="gmap">
                                <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=Las+Rosas+900+Oaxaca+mexico&amp;layer=c&amp;sll=17.081013,-96.717578&amp;cbp=12,61.35,,0,2.26&amp;cbll=17.082084,-96.717446&amp;hl=es-419&amp;ie=UTF8&amp;hq=&amp;hnear=Las+Rosas+900,+Reforma,+Oaxaca,+M%C3%A9xico&amp;ll=17.080769,-96.717635&amp;spn=0.002333,0.003954&amp;t=m&amp;z=14&amp;panoid=aCotOQLhfZBhodY8hC-tRg&amp;source=embed&amp;output=svembed"></iframe>
                            </div>
                            <div class="span7">
                                <address>
                                    <ul class="icons">
                                        <li>
                                            <i class="icon-map-marker"></i>
                                            Calle Las Rosas #900 Col. Reforma, Oaxaca.
                                        </li>
                                        <li><i class="icon-"><img src="images/whatsapp-14px.png" style="margin-left: -8px; margin-top: -6px"></i>(951) 190 66 24</li>
                                    </ul>
                                </address>
                            </div>
                            <div class="span4 pull-right">
                                <ul class="icons">
                                    <li><i class="icon-envelope"></i><a href="mailto:#">reforma@lojuz.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="row-fluid">
                            <strong>USA</strong><br>
                            <div class="gmap">
                                <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?cbll=33.990156,-118.221024&amp;layer=c&amp;panoid=1mSyzbOuGFiVgHaKkZZM_Q&amp;cbp=13,25.88,,1,6.49&amp;ie=UTF8&amp;ll=33.955891,-118.179932&amp;spn=0.51829,1.012115&amp;t=m&amp;z=11&amp;vpsrc=0&amp;output=svembed"></iframe>
                            </div>
                            <div class="span7">
                                <address>
                                    <ul class="icons">
                                        <li>
                                            <i class="icon-map-marker"></i>
                                            2751 E 58TH ST HUNTINGTON PARK<br>
                                            CA 90255 LOS ANGELES CALIFORNIA
                                        </li>
                                        <li>
                                           <i class="icon-phone"></i> (323) 915 7395
                                        </li>
                                    </ul>
                                </address>
                            </div>
                            <div class="span4 pull-right">
                                <ul class="icons">
                                    <li><i class="icon-envelope"></i><a href="mailto:#">usa@lojuz.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-inner">
                    <div class="row-fluid">
                        {{--<p>Curabitur turpis elit, imperdiet a lacinia consequat, posuere in nisi. Etiam sed egestas lacus. Maecenas nec massa quis metus sollicitudin pellentesque in eget purus. Mauris in nibh vel tellus congue tincidunt et non nibh. Nunc sed odio sed felis accumsan scelerisque. Donec sit amet tempor purus. Nunc cursus tortor eu ipsum tincidunt vitae elementum arcu fringilla. Cras consequat tincidunt nisi nec convallis.</p>--}}
                    </div>
                    <div class="row-fluid">
                        <div class="span9">
                            <h3>Envienos un mensaje</h3>
                            <h4>Los campos con (*) son obligatorios</h4>
                            {{ Form::open( array('route' => 'messages.store', 'class' => 'af-form', 'id' => 'af-form', 'name' => 'contact') ) }}
                                @if(Session::has('success'))
                                    <div class="alert-box text-success">
                                        <h4>{{ Session::get('success') }}</h4>
                                    </div>
                                @elseif(Session::has('error'))
                                    <div class="alert-box text-error">
                                        <h4>{{ Session::get('error') }}</h4>
                                    </div>
                                @endif
                                <ul class="errors">
                                    @foreach($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="row-fluid">

                                            <div class="af-outer af-required">
                                                <div class="af-inner">
                                                    {{ Form::text('name', Input::old('name'), 
                                                        array(
                                                            'id' => 'name',
                                                            'size' => 30,
                                                            'placeholder' => '*Indiquenos su nombre.',
                                                            'class' => 'text-input span12 placeholder'
                                                        ))
                                                    }}
                                                    <label class="error" for="name" id="name_error">El nombre es requerido.</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row-fluid">

                                            <div class="af-outer af-required">
                                                <div class="af-inner">
                                                    {{ Form::text('phone', Input::old('phone'), 
                                                        array(
                                                            'id' => 'phone',
                                                            'size' => 30,
                                                            'placeholder' => 'Introduzca su teléfono de contacto aquí. (XXX) XXX-XX-XX',
                                                            'class' => 'text-input span12 placeholder'
                                                        ))
                                                    }}
                                                    <label class="error" for="phone" id="phone_error">El formato del numero telefónico es incorrecto. El formato sugerido es (XXX) XXX-XX-XX</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row-fluid">

                                            <div class="af-outer af-required">
                                                <div class="af-inner">
                                                    {{ Form::textarea('message', Input::old('message'), 
                                                        array(
                                                            'placeholder' => '*Escriba su mensaje aquí.',
                                                            'id' => 'input-message',
                                                            'cols' => 30,
                                                            'class' => 'text-input span12 placeholder'
                                                        ))
                                                    }}
                                                    <label class="error" for="input-message" id="message_error">El mensaje es requerido.</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div class="row-fluid">

                                            <div class="af-outer af-required">
                                                <div class="af-inner">
                                                    {{ Form::text('email', Input::old('email'), 
                                                        array(
                                                            'id' => 'email',
                                                            'size' => 30,
                                                            'placeholder' => '*Introduzca su correo electrónico aquí.',
                                                            'class' => 'text-input span12 placeholder'
                                                        ))
                                                    }}
                                                    <label class="error" for="email" id="email_error">El correo es requerido.</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row-fluid">

                                            <div class="af-outer af-required">
                                                <div class="af-inner">
                                                    {{ Form::select('attendant', array('' => '---- Elija una sucursal ----', '0' => 'Matriz - matriz@lojuz.com', '1' => 'Ciudad Universitaria - cu@lojuz.com', '2' => 'Reforma - reforma@lojuz.com', '3' => 'USA - usa@lojuz.com'), '', array('style' => 'width: 100%;')) }}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row-fluid">

                                            <div class="af-outer af-required" style="padding-bottom: 10px;">
                                                <div class="af-inner">
                                                    {{ Form::captcha() }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">

                                    <div class="af-outer af-required pull-right">
                                        <div class="af-inner">
                                            <input type="submit" name="submit" class="form-button btn btn-primary btn-large" id="submit_btn" value="Enviar mensaje!" />
                                        </div>
                                    </div>

                                </div>
                            {{ Form::close() }}
                        </div>
                        <div class="span3">
                            {{--<section>
                                <h3>Dirección</h3>
                                <address>
                                    <ul class="icons">
                                        <li><i class="icon-map-marker"></i> Xicotencatl 406, Oaxaca, 68000</li>
                                        <li><i class="icon-Teléfono-local"></i>(951) 240-7629</li>
                                        <li><i class="icon-print"></i>(951) 514-6143</li>
                                        <li><i class="icon-envelope"></i><a href="mailto:#">info@polarix-q.com</a></li>
                                    </ul>
                                </address>
                            </section>--}}
                            <section>
                                <h3>Horario de atención</h3>
                                <ul class="unstyled">
                                    <li class="clearfix">Lunes - Viernes: 9 am  to 6 pm</li>
                                    <li class="clearfix">Sabado: 10 am  to 4 pm</li>
                                    <li class="clearfix">Domingo: Cerrado</li>
                                </ul>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- end: Page section -->

    </div>

</div>
<!-- end: Container -->
@stop