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
use Repositories\Interfaces\ProductInterface;
use Repositories\Interfaces\ImageInterface;
use Repositories\Errors\Exceptions\ValidationException as ValidationException;
use Repositories\Errors\Exceptions\NotAllowedException as NotAllowedException;


class ProductsController extends BaseController {

	protected $product;
	protected $catalog;
	protected $image;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.products.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(ProductInterface $product, CatalogInterface $catalog, ImageInterface $image){
		$this->product = $product;
		$this->catalog = $catalog;
		$this->image = $image;
  }

  public function lists()
	{
		try{
			if( Authority::can('index', 'Product') ){
				$catalogs = $this->catalog->findAll();
				$products = $this->product->findAll();
				//dd(DB::getQueryLog());
				$this->layout->content = View::make('admin.products.lists')->with(compact('catalogs', 'products'));
				return $this->layout->render();
			}
			throw new NotAllowedException();
		}
		catch(NotAllowedException $e){
			return Redirect::to('admin/dashboard')->with('error', 'No tienes permiso para visitar esta pagina')->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($catalog_id)
	{
		if( Authority::can('index', 'Product') ){
			$catalog = $this->catalog->findById($catalog_id);
			$products = $this->product->findAllBy($catalog_id);
			$this->layout->content = View::make('admin.products.index')->with(compact('products', 'catalog'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($catalog_id)
	{
		//dd(\Request::is('admin/products/*'));
		if( Authority::can('create', 'Product') ){
			$catalog = $this->catalog->findById($catalog_id);
			$product = $this->product->instance(array('catalog_id' => $catalog_id));
			//$catalogs = $this->catalog->findAll();
			//$catalogs = $catalogs->lists('name', 'id');
			$this->layout->content = View::make('admin.products.create', compact('catalog', 'product'));
			return $this->layout->render();
		}
		throw new NotAllowedException();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($catalog_id)
	{
		try{
			if( Authority::can('create', 'Product') ){
				$input = Input::all();
				$catalog = $this->catalog->findById($catalog_id);
				$product = $this->product->storeIn($catalog->id, $input);
				return Redirect::route('admin.products.show', array($catalog->id, $product->id))->with('success', "El producto '$product->name' ha sido creado correctamente");
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
	public function show($catalog_id, $id)
	{
		//dd($catalog_id, $id);
		if( Authority::can('read', 'Product') ){
			$catalog = $this->catalog->findById($catalog_id);
			//dd($catalog->name);
			$product = $this->product->findByIdIn($catalog->id, $id);
			$this->layout->content = View::make('admin.products.show', compact('catalog', 'product'));
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
	public function edit($catalog_id, $id)
	{
		if( Authority::can('update', 'product') ){
			$catalog = $this->catalog->findById($catalog_id);
			$product = $this->product->findByIdIn($catalog->id, $id);

			//$catalogs = $this->catalog->findAll();
			//$catalogs = $catalogs->lists('name', 'id');
			$imageInstance = $this->image->instance();
			$this->layout->content = View::make('admin.products.edit', compact('catalog', 'product', 'imageInstance'));
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
		if( Authority::can('update', 'Product') ){
			$input = Input::all();
			$catalog = $this->catalog->findById($catalog_id);
			$input['catalog_id'] = $catalog->id;
			$product = $this->product->update($id, $input);
			return Redirect::route('admin.products.show', array($catalog->id, $product->id))->with('success', "El producto '$product->name' ha sido modificado correctamente.");
		}
		throw new NotAllowedException();
	}

	/*public function assign($catalog_id, $id)
	{
		if( Authority::can('update', 'Product') ){
			$catalog = $this->catalog->findById($catalog_id);
			$product = $this->product->assign($catalog->id, $id);
			return Redirect::route('admin.products.index', $catalog->id)->with('success', "El producto '$product->name' ha sido asignado correctamente.");
		}
		throw new NotAllowedException();
	}*/

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($catalog_id, $id)
	{
		if( Authority::can('delete', 'Product') ){
			$catalog = $this->catalog->findById($catalog_id);
			$product = $this->product->destroy($id);
			return Redirect::route('admin.products.index', $catalog->id)->with('success', "El producto ha sido eliminado correctamente.");
		}
		throw new NotAllowedException();
	}

	/*public function unassign($catalog_id, $id)
	{
		if( Authority::can('delete', 'Product') ){
			$product = $this->product->removeFrom($catalog_id, $id);
			return Redirect::route('admin.products.index', $catalog_id)->with('success', "El producto '$product->name' ha sido quitado correctamente.");
		}
		throw new NotAllowedException();
	}*/

}