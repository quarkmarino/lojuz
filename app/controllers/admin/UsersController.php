<?php

namespace Controllers\Admin;
 
//import classes that are not in this new namespace
use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Repositories\Interfaces\UserInterface;
use Repositories\Exceptions\ValidationException as ValidationException;


class UsersController extends BaseController {

	protected $users;

	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'admin.users.layouts.main';

	/**
   * We will use Laravel's dependency injection to auto-magically
   * "inject" our repository instance into our controller
   */
  public function __construct(UserInterface $user){
		$this->user = $user;
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Authority::can('index', 'User') ){
			$users = $this->user->findAll();
			$this->layout->content = View::make('admin.users.index')->with(compact('users'));
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
		if( Authority::can('create', 'User') ){
			$user = $this->user->instance();
			$this->layout->content = View::make('admin.users.create', compact('user'));
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
		if( Authority::can('create', 'User') ){
			$input = Input::all();
			$user = $this->user->store($input);
			return Redirect::route('admin.users.show', $user->id);//->with('success', 'The new user has been created');
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
		if( Authority::can('read', 'User') ){
			$user = $this->user->findById($id);
			$this->layout->content = View::make('admin.users.show', compact('user'));
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
		$user = $this->user->findById($id);
		if( Authority::can('update', $user) ){
			$this->layout->content = View::make('admin.users.edit', compact('user'));
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
		if( Authority::can('update', 'User') ){
			$input = Input::all();
			$user = $this->user->update($id, $input);
			return Redirect::route('admin.users.show', $user->id);//->with('success', 'The new user has been created');
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
		if( Authority::can('delete', 'User') ){
			$this->user->destroy($id);
			return Redirect::route('admin.users.index');//->with('success', 'The user has been deleted');
		}
		throw new NotAllowedException();
	}

}