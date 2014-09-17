<?php

namespace Repositories\Services\Provider;

use Illuminate\Support\ServiceProvider;

class EloquentProvider extends ServiceProvider {

	public function register(){
		$this->app->bind( 'Repositories\\Interfaces\\GalleryInterface', 'Repositories\\ORM\\Eloquent\\Gallery' );
		$this->app->bind( 'Repositories\\Interfaces\\CatalogInterface', 'Repositories\\ORM\\Eloquent\\Catalog' );
		$this->app->bind( 'Repositories\\Interfaces\\ProductInterface', 'Repositories\\ORM\\Eloquent\\Product' );
		$this->app->bind( 'Repositories\\Interfaces\\ImageInterface', 'Repositories\\ORM\\Eloquent\\Image' );
		$this->app->bind( 'Repositories\\Interfaces\\ClientInterface', 'Repositories\\ORM\\Eloquent\\Client' );
		$this->app->bind( 'Repositories\\Interfaces\\NewsInterface', 'Repositories\\ORM\\Eloquent\\News' );
		$this->app->bind( 'Repositories\\Interfaces\\MessageInterface', 'Repositories\\ORM\\Eloquent\\Message' );
	}

}