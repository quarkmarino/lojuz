<?php

namespace Controllers\Admin\Catalog\Product;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Response;
use Repositories\Interfaces\ImageInterface;
use Repositories\Interfaces\ProductInterface;
use Repositories\Errors\Exceptions\ValidationException as ValidationException;
use Repositories\Errors\Exceptions\NotAllowedException as NotAllowedException;


class ImagesController extends BaseController {

	protected $images;
	protected $product;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.images.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(ImageInterface $image, ProductInterface $product){
		$this->image = $image;
		$this->product = $product;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	/*public function index($product_id)
	{
		if( Authority::can('index', 'Image') ){
			$product = $this->product->findById($product_id);
			$images = $this->image->findAllBy('product', $product_id);
			$this->layout->content = View::make('admin.images.index')->with(compact('product', 'images'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}*/

	public function lists()
	{
		if( Authority::can('lists', 'Image') ){
			$images = $this->image->findAllIn('products');
			$this->layout->content = View::make('admin.images.lists')->with(compact('images'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($product_id)
	{
		if( Authority::can('create', 'Image') ){
			$product = $this->product->findById($product_id);
			$image = $this->image->instance(array('product_id' => $product->id));
			$this->layout->content = View::make('admin.images.create', compact('product', 'image'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($product_id)
	{
		try{
			if( Authority::can('create', 'Image') ){
				$input = Input::all();
				$product = $this->product->findById($product_id);
				$image = $this->image->storeIn('product', $product->id, $input);
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
	public function show($product_id, $id)
	{
		if( Authority::can('read', 'Image') ){
			$product = $this->product->findById($product_id);
			$image = $this->image->findByIdIn('product', $product->id, $id);
			$this->layout->content = View::make('admin.images.show', compact('product', 'image'));
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
	public function edit($product_id, $id)
	{
		if( Authority::can('update', 'Image') ){
			$product = $this->product->findById($product_id);
			$image = $this->image->findByIdIn('product', $product_id, $id);
			$this->layout->content = View::make('admin.images.edit', compact('product', 'image'));
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
	public function update($product_id, $id)
	{
		if( Authority::can('update', 'Image') ){
			$input = Input::all();
			$product = $this->product->findById($product_id);
			$image = $this->image->update('product', $product->id, $id, $input);
			return Redirect::route('admin.images.show', array($product->id, $image->id));//->with('success', 'The new image has been created');
		}
		throw new NotAllowedException();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($product_id, $id)
	{
		if( Authority::can('delete', 'Image') ){
			$this->image->destroyIn('product', $product_id, $id);
			return Redirect::route('admin.products.edit', $product->id);//->with('success', 'The image has been deleted');
		}
		throw new NotAllowedException();
	}

}