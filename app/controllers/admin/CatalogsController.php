<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Repositories\Interfaces\CatalogInterface;
use Repositories\Exceptions\ValidationException as ValidationException;


class CatalogsController extends BaseController {

	protected $catalogs;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.catalogs.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(CatalogInterface $catalog){
		$this->catalog = $catalog;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Authority::can('index', 'Catalog') ){
			$catalogs = $this->catalog->findAll();
			$this->layout->content = View::make('admin.catalogs.index')->with(compact('catalogs'));
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
		if( Authority::can('create', 'Catalog') ){
			$catalog = $this->catalog->instance();
			$this->layout->content = View::make('admin.catalogs.create', compact('catalog'));
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
		if( Authority::can('create', 'Catalog') ){
			$input = Input::all();
			$catalog = $this->catalog->store($input);
			return Redirect::route('admin.catalogs.show', $catalog->id);//->with('success', 'The new catalog has been created');
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
		if( Authority::can('read', 'Catalog') ){
			$catalog = $this->catalog->findById($id);
			$this->layout->content = View::make('admin.catalogs.show', compact('catalog'));
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
		$catalog = $this->catalog->findById($id);
		if( Authority::can('update', $catalog) ){
			$this->layout->content = View::make('admin.catalogs.edit', compact('catalog'));
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
		if( Authority::can('update', 'Catalog') ){
			$input = Input::all();
			$catalog = $this->catalog->update($id, $input);
			return Redirect::route('admin.catalogs.show', $catalog->id);//->with('success', 'The new catalog has been created');
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
		if( Authority::can('delete', 'Catalog') ){
			$this->catalog->destroy($id);
			return Redirect::route('admin.catalogs.index');//->with('success', 'The catalog has been deleted');
		}
		throw new NotAllowedException();
	}

}