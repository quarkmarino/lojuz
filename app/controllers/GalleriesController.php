<?php

namespace Controllers;

use Controllers\BaseController;
use Illuminate\Support\Collection;
use Repositories\Interfaces\GalleryInterface;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;


class GalleriesController extends BaseController {

	protected $gallery;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'layouts.main';

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
	public function index(){
		try{
			$galleries = $this->gallery->findAllActive();
			$this->layout->content = \View::make('galleries.index')->with(compact('galleries'));
			return $this->layout->render();
		}
		catch(NotFoundException $e){
			return Redirect::to('/')->with('error', 'La pagina que has solicitado no fue encontrada.');
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
			$gallery = $this->gallery->findByIdActive($id);
			$this->layout->content = \View::make('galleries.show', compact('gallery'));
			return $this->layout->render();
		}
		catch(NotAllowedException $e){
			return Redirect::to('/')->with('error', 'El catalogo que estas buscando no existe, o hay algun problema temporal. Por favor intentalo mas tarde.');
		}
	}

}