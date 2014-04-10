<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Repositories\Interfaces\ProductInterface;
use Repositories\Exceptions\ValidationException as ValidationException;
use Repositories\Errors\Exceptions\NotAllowedException as NotAllowedException;


class ProductsController extends BaseController {

	protected $products;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(ProductInterface $product){
		$this->product = $product;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Authority::can('index', 'Product') ){
			$products = $this->product->findAll();
			$this->layout->content = View::make('admin.products.index')->with(compact('products'));
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
		if( Authority::can('create', 'Product') ){
			$product = $this->product->instance();
			$this->layout->content = View::make('admin.products.create', compact('product'));
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
		if( Authority::can('create', 'Product') ){
			$input = Input::all();
			$product = $this->product->store($input);
			return Redirect::route('admin.products.show', $product->id);//->with('success', 'The new product has been created');
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
		if( Authority::can('read', 'Product') ){
			$product = $this->product->findById($id);
			$this->layout->content = View::make('admin.products.show', compact('product'));
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
		$product = $this->product->findById($id);
		if( Authority::can('update', $product) ){
			$this->layout->content = View::make('admin.products.edit', compact('product'));
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
		if( Authority::can('update', 'Product') ){
			$input = Input::all();
			$product = $this->product->update($id, $input);
			return Redirect::route('admin.products.show', $product->id);//->with('success', 'The new product has been created');
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
		if( Authority::can('delete', 'Product') ){
			$this->product->destroy($id);
			return Redirect::route('admin.products.index');//->with('success', 'The product has been deleted');
		}
		throw new NotAllowedException();
	}

}