<?php

namespace Controllers;

use Controllers\BaseController;
use Illuminate\Support\Collection;
use Repositories\Interfaces\CatalogInterface;
use Repositories\Interfaces\ClientInterface;
use Repositories\Interfaces\NewsInterface;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;

class HomeController extends BaseController {

	protected $catalog;
	protected $client;
	protected $news;

	public $layout = 'layouts.main';

	/**
	 * The layout that should be used for responses.
	 */
	//protected $layout = 'layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(CatalogInterface $catalog, ClientInterface $client, NewsInterface $news){
		$this->catalog = $catalog;
		$this->client = $client;
		$this->news = $news;
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
		//dd($this->tweets);
		$catalogs = $this->catalog->findAllActive();
		$clients = $this->client->findAllActive();
		$news_item = $this->news->findLastActive();
		$this->layout->content = \View::make('home')->with(compact('catalogs', 'clients', 'news_item'));
		return $this->layout->render();
		/*return \View::make('home', compact('catalogs'))->with('tweets', $this->tweets);*/
	}

}