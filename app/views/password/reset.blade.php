@extends('layouts.main')

@section('head_title')
    Recoperación de contraseña
@stop

@section('css')
    @include('assets.css')

    <link rel="stylesheet" href="/css/sign-in.css" type="text/css" media="screen" />
@stop

@section('content')
	<!-- Sign In Option 1 -->
	<div id="sign_in1">
		<div class="container">
			<div class="row">
				<div class="span12 header">
					<h4>Recuperación de contraseña</h4>
				</div>
				<div class="span12 footer">
					{{ Form::open(array('route' => 'reset', 'class' => 'form-inline', 'method' => 'post')) }}
						@if(Session::has('error'))
							<div class="alert-box text-error">
								<h3>{{ Session::get('error') }}</h3>
							</div>
						@elseif(Session::has('status'))
							<div class="alert-box text-info">
								<h3>{{ Session::get('status') }}</h3>
							</div>
						@endif
							{{ Form::text('email', Input::old('email'), array('placeholder' => 'Correo electrónico')) }}
							{{ Form::hidden('token', $token) }}
							{{ Form::password('password') }}
							{{ Form::password('password_confirmation') }}
							{{ Form::submit('Cambiar contraseña', array('style' => 'margin-top: 12px;')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@stop

@section('footer')
		{{--@include('partials.footer')--}}
		@include('partials.footer-menu')
@stop