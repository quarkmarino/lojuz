<?php
namespace Controllers;

use Controllers\BaseController;
use Repositories\Interfaces\CatalogInterface;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;

class CatalogsController extends BaseController {

	protected $catalog;
	
	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'layouts.main';

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
	public function index(){
		try{
			$catalogs = $this->catalog->findAllActive();
			$this->layout->content = \View::make('catalogs.index')->with(compact('catalogs'));
			return $this->layout->render();
		}
		catch(NotFoundException $e){
			return \Redirect::to('admin/dashboard')->with('error', 'La pagina que has solicitado no fue encontrada.');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		try{
			$catalog = $this->catalog->findByIdActive($id);
			$this->layout->content = \View::make('catalogs.show', compact('catalog'));
			return $this->layout->render();
		}
		catch(NotAllowedException $e){
			return \Redirect::to('404')->with('error', 'La galeria que estas buscando no existe, o hay algun problema temporal. Por favor intentalo mas tarde.');
		}
	}

}