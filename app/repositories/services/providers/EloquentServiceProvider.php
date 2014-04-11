<?php

namespace Repositories\Services\Provider;

use Illuminate\Support\ServiceProvider;

class EloquentProvider extends ServiceProvider {

	public function register(){
		$this->app->bind( 'Repositories\\Interfaces\\ProductInterface', 'Repositories\\ORM\\Eloquent\\Product' );
	}

}