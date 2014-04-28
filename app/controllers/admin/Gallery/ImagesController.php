<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Response;
use Repositories\Interfaces\ImageInterface;
use Repositories\Interfaces\GalleryInterface;
use Repositories\Errors\Exceptions\ValidationException as ValidationException;
use Repositories\Errors\Exceptions\NotAllowedException as NotAllowedException;


class GalleryImagesController extends BaseController {

	protected $images;
	protected $gallery;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.galleries.layouts.images';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(ImageInterface $image, GalleryInterface $gallery){
		$this->image = $image;
		$this->gallery = $gallery;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($gallery_id)
	{
		if( Authority::can('index', 'Image') ){
			$gallery = $this->gallery->findById($gallery_id);
			$images = $this->image->findAllBy('gallery', $gallery_id);
			$this->layout->content = View::make('admin.galleries.images.index')->with(compact('gallery', 'images'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($gallery_id)
	{
		if( Authority::can('create', 'Image') ){
			$gallery = $this->gallery->findById($gallery_id);
			$image = $this->image->instance(array('gallery_id' => $gallery_id));
			$this->layout->content = View::make('admin.gallery.images.create', compact('gallery', 'image'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($gallery_id)
	{
		try{
			if( Authority::can('create', 'Image') ){
				$input = Input::all();
				$image = $this->image->storeIn('gallery', $gallery_id, $input);
        return Response::json(array('success' => true, 'file' => asset($image->largethumb), 'name' => $image->name, 'id' => $image->id));
				//return Redirect::route('admin.images.show', $image->id);//->with('success', 'The new image has been created');
			}
			throw new NotAllowedException();
		}
		catch(ValidationException $e){
			return Response::json(array('success' => false, 'error' => 'Los datos provistos no son correctos.' ,'errors' => $e->getErrors()->toArray()));
		}
		catch(NotAllowedException $e){
			return Response::json(array('success' => false, 'errors' => $e->getErrors()));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($gallery_id, $id)
	{
		if( Authority::can('read', 'Image') ){
			$gallery = $this->gallery->findById($gallery_id);
			$image = $this->image->findByIdIn('gallery', $gallery->id, $id);
			$this->layout->content = View::make('admin.galleries.images.show', compact('gallery', 'image'));
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
	public function edit($gallery_id, $id)
	{
		if( Authority::can('update', 'Image') ){
			$gallery = $this->gallery->findById($gallery_id);
			$image = $this->image->findByIdIn('gallery', $gallery->id, $id);
			$this->layout->content = View::make('admin.galleries.images.edit', compact('gallery', 'image'));
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
	public function update($gallery_id, $id)
	{
		if( Authority::can('update', 'Image') ){
			$input = Input::all();
			$gallery = $this->gallery->findById($gallery_id);
			$image = $this->image->updateIn('gallery', $gallery->id, $id, $input);
			return Redirect::route('admin.galleries.images.show', $image->id);//->with('success', 'The new image has been created');
		}
		throw new NotAllowedException();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($gallery_id, $id)
	{
		if( Authority::can('delete', 'Image') ){
			$this->image->destroyIn('gallery', $gallery_id, $id);
			return Redirect::route('admin.galleries.edit', array($gallery_id));//->with('success', 'The image has been deleted');
		}
		throw new NotAllowedException();
	}

}