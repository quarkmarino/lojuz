<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Repositories\Interfaces\ClientInterface;
use Repositories\Exceptions\ValidationException as ValidationException;


class ClientsController extends BaseController {

	protected $clients;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.clients.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(ClientInterface $client){
		$this->client = $client;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Authority::can('index', 'Client') ){
			$clients = $this->client->findAll();
			$this->layout->content = View::make('admin.clients.index')->with(compact('clients'));
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
		if( Authority::can('create', 'Client') ){
			$client = $this->client->instance();
			$this->layout->content = View::make('admin.clients.create', compact('client'));
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
		if( Authority::can('create', 'Client') ){
			$input = Input::all();
			$client = $this->client->store($input);
			return Redirect::route('admin.clients.show', $client->id);//->with('success', 'The new client has been created');
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
		if( Authority::can('read', 'Client') ){
			$client = $this->client->findById($id);
			$this->layout->content = View::make('admin.clients.show', compact('client'));
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
		$client = $this->client->findById($id);
		if( Authority::can('update', $client) ){
			$this->layout->content = View::make('admin.clients.edit', compact('client'));
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
		if( Authority::can('update', 'Client') ){
			$input = Input::all();
			$client = $this->client->update($id, $input);
			return Redirect::route('admin.clients.show', $client->id);//->with('success', 'The new client has been created');
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
		if( Authority::can('delete', 'Client') ){
			$this->client->destroy($id);
			return Redirect::route('admin.clients.index');//->with('success', 'The client has been deleted');
		}
		throw new NotAllowedException();
	}

}