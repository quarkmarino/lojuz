<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Repositories\Interfaces\CatalogInterface;
use Repositories\Interfaces\ProductInterface;
use Repositories\Interfaces\ImageInterface;
use Repositories\Errors\Exceptions\ValidationException as ValidationException;
use Repositories\Errors\Exceptions\NotAllowedException as NotAllowedException;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;


class ProductsController extends BaseController {

	protected $product;
	protected $catalog;
	protected $image;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(ProductInterface $product, CatalogInterface $catalog, ImageInterface $image){
		$this->product = $product;
		$this->catalog = $catalog;
		$this->image = $image;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		try{
			if( Authority::can('index', 'Product') ){
				$products = $this->product->findAll();
				$orphans = $this->product->findAllOrphan();
				//dd(DB::getQueryLog());
				$this->layout->content = View::make('admin.products.index')->with(compact('products', 'orphans'));
				return $this->layout->render();
			}
			throw new NotAllowedException();
		}
		catch(NotAllowedException $e){
			return Redirect::to('admin/dashboard')->with('error', 'No tienes permiso para visitar esta pagina')->withInput()->withErrors($e->getErrors());
		}
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
			$catalogs = $this->catalog->findAll();
			$catalogs = $catalogs->lists('name', 'id');
			$this->layout->content = View::make('admin.products.create', compact('product', 'catalogs'));
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
			if( Authority::can('create', 'Product') ){
				$input = Input::all();
				$product = $this->product->store($input);
				return Redirect::route('admin.catalogs.products.show', array($product->catalog_id, $product->id));//->with('success', 'The new product has been created');
			}
			throw new NotAllowedException();
		}
		catch(ValidationException $e){
			return Redirect::to('admin/products/create')->with('error', 'Los datos provistos no son correctos.')->withInput()->withErrors($e->getErrors());
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
		try{
			if( Authority::can('read', 'Product') ){
				$product = $this->product->findById($id);
				$this->layout->content = View::make('admin.products.show', compact('product'));
				return $this->layout->render();
			}
			throw new NotAllowedException();
		}
		catch(NotAllowedException $e){
			return Redirect::to('admin/dashboard')->with('error', 'No tienes permiso para visitar esta página.');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if( Authority::can('update', 'product') ){
			$product = $this->product->findById($id);
			$catalogs = $this->catalog->findAll();
			$catalogs = $catalogs->lists('name', 'id');
			$imageInstance = $this->image->instance();
			$this->layout->content = View::make('admin.products.edit', compact('product', 'catalogs', 'imageInstance'));
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
		try{
			if( Authority::can('update', 'Product') ){
				$input = Input::all();
				//dd($input['description']);
				$product = $this->product->update($id, $input);
				if($product->catalog_id !== null)	
					return Redirect::route('admin.catalogs.products.show', array($product->catalog_id, $product->id));
				return Redirect::route('admin.products.show', $product->id);
			}
			throw new NotAllowedException();
		}
		catch(ValidationException $e){
			return Redirect::route("admin.products.edit", $id)->with('error', 'Los datos provistos no son correctos.')->withInput()->withErrors($e->getErrors());
		}
		catch(NotAllowedException $e){
			return Redirect::route('admin.dashboard')->with('error', 'No tienes permiso para visitar esta página.');
		}
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
			return Redirect::route('admin.products.index')->with('success', 'El producto ');
		}
		throw new NotAllowedException();
	}

}