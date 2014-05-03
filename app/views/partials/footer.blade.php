<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="span4">
				<h3 class="widget-title">Dirección</h3>
				<div class="widget-inner">
					<address>
						<ul class="icons">
							<li><i class="icon-map-marker"></i> Xicotencatl 406, Oaxaca, 68000</li>
							<li><i class="icon-phone"></i>(951) 240-7629</li>
							<li><i class="icon-print"></i>(951) 514-6143</li>
							<li><i class="icon-envelope"></i><a href="mailto:#">info@polarix-q.com</a></li>
						</ul>
					</address>
					<p><a href="contact" class="btn btn-primary">Contactenos</a></p>
				</div>
				<h3 class="widget-title">Siganos</h3>
				<div class="widget-inner">
					<ul class="social clearfix">
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
					<li>
						<a href="#" data-original-title="Linkedin" data-placement="top" rel="tooltip">
							<i class="icon-linkedin-sign"></i>
						</a>
					</li>
					<li>
						<a href="#" data-original-title="Pinterest" data-placement="top" rel="tooltip">
							<i class="icon-pinterest-sign"></i>
						</a>
					</li>
					<li>
						<a href="#" data-original-title="Google+" data-placement="top" rel="tooltip">
							<i class="icon-google-plus-sign"></i>
						</a>
					</li>
					</ul>
				</div>
			</div>
			<div class="span4">
				<h3 class="widget-title">Acerca de</h3>
				<div class="widget-inner">
					<p>Ut eu nulla eget massa blandit eleifend vel sedis lacus. Sed at viverra nulla. Fusce vel adipisci odio. Phasellus commodo, mauris eget pharetra scelerisque, est justo lacinia tortor.</p>
				</div>
				<h3 class="widget-title">Reciba nuetras noticias</h3>
				<div class="widget-inner">
					<p>Registrese para recibir nuestras novedades. Nunca compartiremos su correo electronico.</p>
					<form>
						<div class="input-append">
							<input type="email" name="email" class="span3" placeholder="Email Address">
							<button class="btn btn-primary">Regístrese</button>
						</div>
					</form>
				</div>
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