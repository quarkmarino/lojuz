<?php

namespace Controllers;

use Controllers\BaseController;
use Illuminate\Support\Collection;
use Repositories\Interfaces\ProductInterface;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;

class ProductsController extends BaseController {

	protected $product;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(ProductInterface $product){
		$this->product = $product;
  }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		try{
			$product = $this->product->findById($id);
			$related_products = $this->product->findRelated($id);
			//dd(\DB::getQueryLog());
			$this->layout->content = \View::make('products.show', compact('product', 'related_products'));
			return $this->layout->render();
		}
		catch(NotFoundException $e){
			return Redirect::to('/')->with('error', 'El producto que estas buscando no existe, o hay algun problema al temporal. Por favor intentalo mas tarde.');
		}
	}

}