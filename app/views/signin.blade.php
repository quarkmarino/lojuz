@extends('layouts.main')

@section('head_title')
    Acceso
@stop

@section('css')
    @include('assets.css')

    <link rel="stylesheet" href="css/sign-in.css" type="text/css" media="screen" />
@stop

@section('content')
	<!-- Sign In Option 1 -->
	<div id="sign_in1">
		<div class="container">
			<div class="row">
				<div class="span12 header">
					<h4>Panel de administación</h4>
					{{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis erat non lectus suscipit, at commodo mi feugiat.</p>
					<div class="span4 social">
						<a href="#" class="circle facebook"><img src="img/face.png" alt=""></a>
						<a href="#" class="circle twitter"><img src="img/twt.png" alt=""></a>
						<a href="#" class="circle gplus"><img src="img/gplus.png" alt=""></a>
					</div>--}}
				</div>

				{{--<div class="span3 division">
					<div class="line l"></div>
					<span>ó</span>
					<div class="line r"></div>
				</div>--}}

				<div class="span12 footer">
					{{ Form::open(array('url' => 'signin', 'class' => 'form-inline')) }}
					@if(Session::has('error'))
						<div class="alert-box text-error">
							<h3>{{ Session::get('error') }}</h3>
						</div>
					@endif
						{{ Form::text('username', Input::old('username'), array('placeholder' => 'Nombre de usuario')) }}
						{{ Form::password('password', '', array('placeholder' => 'Contraseña')) }}
						{{ Form::submit('Acceder') }}
					{{ Form::close() }}
				</div>

				<div class="span12 proof">
					<div class="span5 remember">
						{{--<label class="checkbox">
							<input type="checkbox"> Recordarme
						</label>--}}
						¿Olvido sus datos? <a href="/remind">Recuperar contraseña</a>
					</div>

					{{--<div class="span3 dosnt">
						<span>¿Aun no tiene una cuenta?</span>
						<a href="sign-up">Registrarse</a>
					</div>--}}
				</div>
			</div>
		</div>
	</div>

	<!-- Sign In Option 2 -->
	{{--<div id="sign_in2">
		<div class="container">
			<div class="section_header">
				<h3>Acceso <span>(opción 2)</span></h3>
			</div>
			<div class="row login">
				<div class="span5 left_box">
					<h4>Accede a tu cuenta</h4>

					<div class="perk_box">
						<div class="perk">
							<span class="icos ico1"></span>
							<p><strong>Lorem ipsum dolor</strong> sit amet, consectetur adipiscing elit. Sed lobortis erat.</p>
						</div>
						<div class="perk">
							<span class="icos ico2"></span>
							<p><strong>Interdum et malesuada fames</strong> ac ante ipsum primis in faucibus. Vivamus pharetra molestie mattis. Aenean rhoncus.</p>
						</div>
						<div class="perk">
							<span class="icos ico3"></span>
							<p><strong>Vivamus pharetra molestie</strong> congue vehicula venenatis.</p>
						</div>
					</div>
				</div>

				<div class="span6 signin_box">
					<div class="box">
						<div class="box_cont">

							<div class="social">
								<a href="#" class="circle facebook"><img src="img/face.png" alt=""></a>
								<a href="#" class="circle twitter"><img src="img/twt.png" alt=""></a>
								<a href="#" class="circle gplus"><img src="img/gplus.png" alt=""></a>
							</div>

							<div class="division">
								<div class="line l"></div>
								<span>or</span>
								<div class="line r"></div>
							</div>

							<div class="form">
								<form>
									<input type="text" placeholder="Correo electrónico">
									<input type="text" placeholder="Contraseña">
									<input type="text" placeholder="Confirmar contraseña">
									<div class="forgot">
										<span>¿Aun no tiene una cuenta?</span>
										<a href="sign-up">Resgistrarse</a>
									</div>
									<input type="submit" value="Acceder">
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>--}}
@stop

@section('footer')
		{{--@include('partials.footer')--}}
		@include('partials.footer-menu')
@stop