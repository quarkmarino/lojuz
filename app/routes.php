<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


	Route::get('/', array( 'uses' => 'Controllers\HomeController@showWelcome'));

	Route::get('about', function(){ return View::make('about'); });

	Route::resource('catalogs', 'Controllers\CatalogsController', array('only' => array('index', 'show')));

	Route::resource('products', 'Controllers\ProductsController', array('only' => array('show')));

	Route::resource('galleries', 'Controllers\GalleriesController', array('only' => array('index', 'show')));

	Route::resource('news', 'Controllers\NewsController', array('only' => array('index')));

	Route::get('contact', function(){ return View::make('contact'); });

	Route::get('signin', function(){ return View::make('signin'); });

	Route::post('signin', function(){ 

		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		);

		if( Auth::attempt($credentials) ){
			return Redirect::to('admin/dashboard');
		}
		return Redirect::to('signin');
	});

	Route::get('signout', function(){ Auth::logout(); return Redirect::to('signin');  });

	Route::group(array('prefix' => 'admin', 'before' => 'auth'), function(){
		/*
		|--------------------------------------------------------------------------
		| Admin home Route
		|--------------------------------------------------------------------------
		*/

		Route::get('dashboard', array( 'as' => 'admin.home', function(){ return View::make('admin.home'); }));

		/*
		|--------------------------------------------------------------------------
		| News, Clients, Users Routes
		|--------------------------------------------------------------------------
		*/

		Route::resource('news', 'Controllers\Admin\NewsController');
		Route::get('news/{news}/delete', array( 'uses' => 'Controllers\Admin\NewsController@destroy', 'as' => 'admin.news.destroy'));

		Route::resource('clients', 'Controllers\Admin\ClientsController');
		Route::get('clients/{clients}/delete', array( 'uses' => 'Controllers\Admin\ClientsController@destroy', 'as' => 'admin.clients.destroy'));

		Route::group(array('before' => 'csrf'), function() {
			Route::resource('clients', 'Controllers\Admin\ClientsController', array('only' => array('store', 'update')));
			Route::resource('news', 'Controllers\Admin\NewsController', array('only' => array('store', 'update')));
		});

		Route::resource('users', 'Controllers\Admin\UsersController');

		/*
		|--------------------------------------------------------------------------
		| Catalog Routes
		|--------------------------------------------------------------------------
		*/

		Route::resource('catalogs', 'Controllers\Admin\CatalogsController', array('except' => array('store', 'update', 'destroy')));
		Route::get('catalogs/{catalogs}/delete', array( 'uses' => 'Controllers\Admin\CatalogsController@destroy', 'as' => 'admin.catalogs.destroy'));

		/*Route::get('catalogs/images/', array( 'uses' => 'Controllers\Admin\Catalog\ImagesController@lists', 'as' => 'admin.catalogs.images.lists'));*/
		Route::resource('catalogs.images', 'Controllers\Admin\Catalog\ImagesController', array('only' => array('edit')));
		Route::get('catalogs/{catalogs}/images/{images}/delete', array( 'uses' => 'Controllers\Admin\Catalog\ImagesController@destroy', 'as' => 'admin.catalogs.images.destroy'));

		Route::resource('catalogs.products', 'Controllers\Admin\Catalog\ProductsController', array('except' => array('store', 'update', 'destroy')));
		Route::get('catalogs/{catalogs}/products/{products}/delete', array( 'uses' => 'Controllers\Admin\Catalog\ProductsController@destroy', 'as' => 'admin.catalogs.products.destroy'));

		Route::group(array('before' => 'csrf'), function() {
			Route::resource('catalogs', 'Controllers\Admin\CatalogsController', array('only' => array('store', 'update')));
			Route::resource('catalogs.images', 'Controllers\Admin\Catalog\ImagesController', array('only' => array('store', 'update')));
			Route::resource('catalogs.products', 'Controllers\Admin\Catalog\ProductsController', array('only' => array('store', 'update')));
		});

		/*
		|--------------------------------------------------------------------------
		| Product Routes
		|--------------------------------------------------------------------------
		*/

		Route::get('products/', array( 'uses' => 'Controllers\Admin\Catalog\ProductsController@lists', 'as' => 'admin.products.lists'));

		Route::get('products/images/', array( 'uses' => 'Controllers\Admin\Catalog\Product\ImagesController@lists', 'as' => 'admin.products.images.lists'));
		Route::resource('products.images', 'Controllers\Admin\Catalog\Product\ImagesController', array('only' => array('index', 'edit')));
		Route::get('products/{products}/images/{images}/delete', array( 'uses' => 'Controllers\Admin\Catalog\Product\ImagesController@destroy', 'as' => 'admin.products.images.destroy'));

		Route::group(array('before' => 'csrf'), function() {
			Route::resource('products.images', 'Controllers\Admin\Catalog\Product\ImagesController', array('only' => array('store', 'update')));
		});

		/*
		|--------------------------------------------------------------------------
		| Gallery Routes
		|--------------------------------------------------------------------------
		*/

		Route::get('galleries/', array( 'uses' => 'Controllers\Admin\GalleriesController@index', 'as' => 'admin.galleries.lists'));

		Route::get('galleries/images/', array( 'uses' => 'Controllers\Admin\Gallery\ImagesController@lists', 'as' => 'admin.galleries.images.lists'));

		Route::resource('galleries', 'Controllers\Admin\GalleriesController', array('except' => array('store', 'update', 'destroy')));
		Route::get('galleries/{galleries}/delete', array( 'uses' => 'Controllers\Admin\GalleriesController@destroy', 'as' => 'admin.galleries.destroy'));

		Route::resource('galleries.images', 'Controllers\Admin\Gallery\ImagesController', array('except' => array('store', 'update', 'destroy')));
		Route::get('galleries/{galleries}/images/{images}/delete', array( 'uses' => 'Controllers\Admin\Gallery\ImagesController@destroy', 'as' => 'admin.galleries.images.destroy'));

		Route::group(array('before' => 'csrf'), function() {
			Route::resource('galleries', 'Controllers\Admin\GalleriesController', array('only' => array('store', 'update')));
			Route::resource('galleries.images', 'Controllers\Admin\Gallery\ImagesController', array('only' => array('store', 'update')));
		});

		/*Route::resource('posts', 'Controllers\Admin\PostsController');
		Route::resource('posts.comments', 'CommentsController');
		Route::resource('posts.images', 'ImagesController');*/
	});