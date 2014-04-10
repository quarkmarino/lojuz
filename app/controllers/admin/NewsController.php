<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Repositories\Interfaces\NewsInterface;
use Repositories\Exceptions\ValidationException as ValidationException;

class NewsController extends BaseController {

	protected $news;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.news.layouts.main';

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
	public function index()
	{
		if( Authority::can('index', 'News') ){
			$news = $this->news->findAll();
			$this->layout->content = View::make('admin.news.index')->with(compact('news'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if( Authority::can('create', 'News') ){
			$news = $this->news->instance();
			$this->layout->content = View::make('admin.news.create', compact('news'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if( Authority::can('create', 'News') ){
			$input = Input::all();
			$news = $this->news->store($input);
			return Redirect::route('admin.news.show', $news->id);//->with('success', 'The new news has been created');
		}
		throw new NotAllowedException();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if( Authority::can('read', 'News') ){
			$news = $this->news->findById($id);
			$this->layout->content = View::make('admin.news.show', compact('news'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$news = $this->news->findById($id);
		if( Authority::can('update', $news) ){
			$this->layout->content = View::make('admin.news.edit', compact('news'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if( Authority::can('update', 'News') ){
			$input = Input::all();
			$news = $this->news->update($id, $input);
			return Redirect::route('admin.news.show', $news->id);//->with('success', 'The new news has been created');
		}
		throw new NotAllowedException();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if( Authority::can('delete', 'News') ){
			$this->news->destroy($id);
			return Redirect::route('admin.news.index');//->with('success', 'The news has been deleted');
		}
		throw new NotAllowedException();
	}
}