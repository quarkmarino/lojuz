<?php

namespace Controllers\Admin\Catalog;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Response;
use Repositories\Interfaces\CatalogInterface;
use Repositories\Interfaces\ImageInterface;
use Repositories\Errors\Exceptions\ValidationException as ValidationException;
use Repositories\Errors\Exceptions\NotAllowedException as NotAllowedException;


class ImagesController extends BaseController {

	protected $catalog;
	protected $image;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.catalogs.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(CatalogInterface $catalog, ImageInterface $image){
		$this->catalog = $catalog;
		$this->image = $image;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	/*public function index($catalog_id)
	{
		if( Authority::can('index', 'Image') ){
			$catalog = $this->catalog->findById($catalog_id);
			$images = $this->image->findAllBy('catalog', $catalog->id);
			$this->layout->content = View::make('admin.images.index')->with(compact('catalog','images'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}*/

	public function lists($catalog_id)
	{
		if( Authority::can('index', 'Image') ){
			$catalog = $this->catalog->findById($catalog_id);
			$images = $this->image->findAllIn('catalogs');
			$this->layout->content = View::make('admin.images.index')->with(compact('catalog','images'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	/*public function create($catalog_id)
	{
		//dd(\Request::is('admin/products/*'));
		if( Authority::can('create', 'Image') ){
			$image = $this->image->instance(array('catalog_id' => $catalog_id));
			$this->layout->content = View::make('admin.images.create', compact('image'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}*/

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($catalog_id)
	{
		try{
			if( Authority::can('create', 'Image') ){
				$input = Input::all();
				$image = $this->image->storeIn('catalog', $catalog_id, $input);
        return Response::json(array('success' => true, 'file' => asset($image->slide), 'name' => $image->name, 'id' => $image->id));
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
	/*public function show($catalog_id, $id)
	{
		if( Authority::can('read', 'Image') ){
			$catalog = $this->catalog->findById($catalog_id);
			$image = $this->image->findByIdIn('catalog', $catalog->id, $id);
			$this->layout->content = View::make('admin.images.show', compact('catalog', 'image'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}*/

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($catalog_id, $id)
	{
		if( Authority::can('update', 'Image') ){
			$owner = $this->catalog->findById($catalog_id);
			$image = $this->image->findByIdIn('catalog', $owner->id, $id);
			$class = 'catalogs';
			$this->layout->content = View::make('admin.images.edit', compact('owner', 'image', 'class'));
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
	public function update($catalog_id, $id)
	{
		if( Authority::can('update', 'Image') ){
			$catalog = $this->catalog->findById($catalog_id);
			$product = $this->product->assign($catalog_id, $id);
			return Redirect::route('admin.catalogs.products.index', $catalog->id)->with('success', "El producto \"$product->name\" ha sido asignado correctamente.");
		}
		throw new NotAllowedException();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($catalog_id, $id)
	{
		if( Authority::can('delete', 'Image') ){
			$this->image->destroyIn('catalog', $catalog_id, $id);
			return Redirect::route('admin.catalogs.edit', $catalog_id);//->with('success', 'The product has been deleted');
		}
		throw new NotAllowedException();
	}

}