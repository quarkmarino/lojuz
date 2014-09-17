<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Repositories\Interfaces\NewsInterface;
use Repositories\Interfaces\CatalogInterface;
use Repositories\Interfaces\ProductInterface;
use Repositories\Exceptions\ValidationException as ValidationException;

class NewsController extends BaseController {

	protected $news;
	protected $catalog;
	protected $product;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.news.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(NewsInterface $news, CatalogInterface $catalog, ProductInterface $product){
		$this->news = $news;
		$this->catalog = $catalog;
		$this->product = $product;
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
			$news_item = $this->news->instance();
			$catalogs = $this->catalog->findAll();
			$options = $catalogs->lists('id', 'name');
			foreach($catalogs as $catalog){
				$options[$catalog->name] = $catalog->products->lists('name', 'id');
			}
			$options = array_merge(array('' => '-- Producto --'), $options);
			$this->layout->content = View::make('admin.news.create', compact('news_item', 'options'));
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
		try{
			if( Authority::can('create', 'News') ){
				$input = Input::all();
				$news = $this->news->store(\Auth::user()->id, $input);
				return Redirect::route('admin.news.show', $news->id);//->with('success', 'The new news has been created');
			}
			throw new NotAllowedException();
		}
		catch(ValidationException $e){
			return Redirect::route('admin.news.create')->with('error', 'Los datos provistos no son correctos.')->withInput()->withErrors($e->getErrors());
		}
		catch(NotAllowedException $e){
			return Redirect::to('admin/dashboard')->with('error', 'No tienes permiso para visitar esta página.');
		}
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
			$news_item = $this->news->findById($id);
			$this->layout->content = View::make('admin.news.show', compact('news_item'));
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
		if( Authority::can('update', 'News') ){
			$news_item = $this->news->findById($id);
			$catalogs = $this->catalog->findAll();
			$options = $catalogs->lists('id', 'name');
			foreach($catalogs as $catalog){
				$options[$catalog->name] = $catalog->products->lists('name', 'id');
			}
			$options = array_merge(array('' => '-- Producto --'), $options);
			$this->layout->content = View::make('admin.news.edit', compact('news_item', 'options'));
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