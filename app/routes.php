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

Route::get('/', function(){ return View::make('home'); });

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
	Route::get('dashboard', function(){ return View::make('admin.home'); });

	Route::resource('news', 'Controllers\Admin\NewsController');

	Route::resource('clients', 'Controllers\Admin\ClientsController');

	Route::resource('catalogs', 'Controllers\Admin\CatalogsController');

	Route::resource('products', 'Controllers\Admin\ProductsController');
	Route::resource('products.images', 'Controllers\Admin\ProductImagesController');

	Route::resource('galleries', 'Controllers\Admin\GalleriesController');
	Route::resource('galleries.images', 'Controllers\Admin\GalleryImagesController');

	Route::resource('users', 'Controllers\Admin\UsersController');

	/*Route::resource('posts', 'Controllers\Admin\PostsController');
	Route::resource('posts.comments', 'CommentsController');
	Route::resource('posts.images', 'ImagesController');*/
});