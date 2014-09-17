<?php

namespace Controllers;

use Controllers\BaseController;
use Illuminate\Support\Collection;
use Repositories\Interfaces\NewsInterface;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;

class NewsController extends BaseController {

	protected $news;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(NewsInterface $news){
		$this->news = $news;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		try{
			$news = $this->news->findAllActive();
			$this->layout->content = \View::make('news.index')->with(compact('news'));
			return $this->layout->render();
		}
		catch(NotFoundException $e){
			return Redirect::to('/')->with('error', 'La pagina que has solicitado no fue encontrada.');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function show($id)
	{
		//
	}*/

}