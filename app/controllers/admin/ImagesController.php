<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Repositories\Interfaces\ImageInterface;
use Repositories\Exceptions\ValidationException as ValidationException;


class ImagesController extends BaseController {

	protected $images;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.images.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(ImageInterface $image){
		$this->image = $image;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Authority::can('index', 'Image') ){
			$images = $this->image->findAll();
			$this->layout->content = View::make('admin.images.index')->with(compact('images'));
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
		if( Authority::can('create', 'Image') ){
			$image = $this->image->instance();
			$this->layout->content = View::make('admin.images.create', compact('image'));
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
		if( Authority::can('create', 'Image') ){
			$input = Input::all();
			$image = $this->image->store($input);
			return Redirect::route('admin.images.show', $image->id);//->with('success', 'The new image has been created');
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
		if( Authority::can('read', 'Image') ){
			$image = $this->image->findById($id);
			$this->layout->content = View::make('admin.images.show', compact('image'));
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
		$image = $this->image->findById($id);
		if( Authority::can('update', $image) ){
			$this->layout->content = View::make('admin.images.edit', compact('image'));
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
		if( Authority::can('update', 'Image') ){
			$input = Input::all();
			$image = $this->image->update($id, $input);
			return Redirect::route('admin.images.show', $image->id);//->with('success', 'The new image has been created');
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
		if( Authority::can('delete', 'Image') ){
			$this->image->destroy($id);
			return Redirect::route('admin.images.index');//->with('success', 'The image has been deleted');
		}
		throw new NotAllowedException();
	}

}