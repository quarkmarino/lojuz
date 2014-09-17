<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="span4">
				<h3 class="widget-title">Dirección</h3>
				<div class="widget-inner">
					<address>
						<ul class="icons">
							<li><i class="icon-map-marker"></i>SAN SEBASTIAN ETLA OAXACA</li>
							<li>(Cerca de gasolinera y oxxo caporales)</li>
							<li><i class="icon-phone"></i>(951) 521 33 33</li>
							<li><i class="icon-mobile-phone"></i>(951) 199 66 66</li>
							<li><i class="icon-envelope"></i><a href="mailto:matriz@lojuz.com">matriz@lojuz.com</a></li>
						</ul>
					</address>
					<p><a href="contact" class="btn btn-primary">Contactenos</a></p>
				</div>
			</div>
			<div class="span4">
				<h3 class="widget-title">Acerca de Lojuz</h3>
				<div class="widget-inner">
					<p>
              Somos una empresa dedicada a la fabricación de uniformes escolares, deportivos y empresariales.
          </p>
          <p>
              Nuestra prioridad es ofrecerle productos de gran calidad confort y durabilidad para el desarrollo óptimo en las actividades que usted desempeña.
          </p>
				</div>
				<div class="row-fluid">
					<h3 class="widget-title span3">Siganos</h3>
					<div class="span6" style="margin-top: 17px;">
						<ul class="social">
							<li>
								<a href="#" data-original-title="Facebook" data-placement="top" rel="tooltip">
									<i class="icon-facebook-sign"></i>
								</a>
							</li>
							<li>
								<a href="#" data-original-title="Twitter" data-placement="top" rel="tooltip">
									<i class="icon-twitter-sign"></i>
								</a>
							</li>
							{{--<li>
								<a href="#" data-original-title="Linkedin" data-placement="top" rel="tooltip">
									<i class="icon-linkedin-sign"></i>
								</a>
							</li>
							<li>
								<a href="#" data-original-title="Pinterest" data-placement="top" rel="tooltip">
									<i class="icon-pinterest-sign"></i>
								</a>
							</li>--}}
							<li>
								<a href="#" data-original-title="Google+" data-placement="top" rel="tooltip">
									<i class="icon-google-plus-sign"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
				{{--<h3 class="widget-title">Reciba nuetras noticias</h3>
				<div class="widget-inner">
					<p>Registrese para recibir nuestras novedades. Nunca compartiremos su correo electronico.</p>
					<form>
						<div class="input-append">
							<input type="email" name="email" class="span3" placeholder="Email Address">
							<button class="btn btn-primary">Regístrese</button>
						</div>
					</form>
				</div>--}}
			</div>
			<div class="span4">
				<h3 class="widget-title">Últimas noticias</h3>
				<div class="widget-inner">
					<ul class="icons lates-blog-post">
						@if(!empty($tweets))
							@foreach($tweets as $tweet)
								<li>
									<i class="icon-chevron-right"></i>
									<a href="{{ $tweet['user']['url'] }}" target="_blank">{{ ucfirst($tweet['user']['screen_name']) }}</a><br>
									@foreach( $tweet['entities']['hashtags'] as $hashtag )
									@endforeach
									@foreach( $tweet['entities']['symbols'] as $symbol )
									@endforeach
									@foreach( $tweet['entities']['urls'] as $url )
										<?php $tweet['text'] = str_replace($url['url'], HTML::link($url['url'], $url['url'], array('target' => '_black')), $tweet['text']); ?>
									@endforeach
									@foreach( $tweet['entities']['user_mentions'] as $user_mention )
										<?php $tweet['text'] = str_replace('@'.$user_mention['screen_name'], HTML::link('http://twitter.com/'.$user_mention['screen_name'], '@'.$user_mention['screen_name'], array('target' => '_black')), $tweet['text']); ?>
									@endforeach
									{{ $tweet['text'] }}
								</li>
							@endforeach
						@else
							<li>Problema al cargar los tweets ...</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>