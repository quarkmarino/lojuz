<?php

namespace Controllers;

use Controllers\BaseController;
use Illuminate\Support\Collection;
use Repositories\Interfaces\CatalogInterface;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;

class HomeController extends BaseController {

	protected $catalog;

	/**
	 * The layout that should be used for responses.
	 */
	//protected $layout = 'layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(CatalogInterface $catalog){
		$this->catalog = $catalog;
  }

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		$catalogs = $this->catalog->find();
		/*$this->layout->content = \View::make('catalogs.index')->with(compact('catalogs'));
		return $this->layout->render();*/
		return \View::make('home', compact('catalogs'));
	}

}