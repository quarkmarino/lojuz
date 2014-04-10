<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Repositories\Interfaces\GalleryInterface;
use Repositories\Exceptions\ValidationException as ValidationException;

class GalleriesController extends BaseController {

	protected $galleries;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.galleries.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(GalleryInterface $gallery){
		$this->gallery = $gallery;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Authority::can('index', 'Gallery') ){
			$galleries = $this->gallery->findAll();
			$this->layout->content = View::make('admin.galleries.index')->with(compact('galleries'));
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
		if( Authority::can('create', 'Gallery') ){
			$gallery = $this->gallery->instance();
			$this->layout->content = View::make('admin.galleries.create', compact('gallery'));
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
		if( Authority::can('create', 'Gallery') ){
			$input = Input::all();
			$gallery = $this->gallery->store($input);
			return Redirect::route('admin.galleries.show', $gallery->id);//->with('success', 'The new gallery has been created');
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
		if( Authority::can('read', 'Gallery') ){
			$gallery = $this->gallery->findById($id);
			$this->layout->content = View::make('admin.galleries.show', compact('gallery'));
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
		$gallery = $this->gallery->findById($id);
		if( Authority::can('update', $gallery) ){
			$this->layout->content = View::make('admin.galleries.edit', compact('gallery'));
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
		if( Authority::can('update', 'Gallery') ){
			$input = Input::all();
			$gallery = $this->gallery->update($id, $input);
			return Redirect::route('admin.galleries.show', $gallery->id);//->with('success', 'The new gallery has been created');
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
		if( Authority::can('delete', 'Gallery') ){
			$this->gallery->destroy($id);
			return Redirect::route('admin.galleries.index');//->with('success', 'The gallery has been deleted');
		}
		throw new NotAllowedException();
	}

}