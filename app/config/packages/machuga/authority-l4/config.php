<?php
	return array(

	'initialize' => function($authority){
		//dd($authority);
		$user = $authority->getCurrentUser();

		$authority->addAlias('admin', array('lists', 'index', 'create', 'read', 'update', 'delete'));

		//dd($user->toArray(), $user->roles->toArray());
		if($user->hasRole('admin')) {
			$authority->allow('admin', 'all');
		}

		if($user->hasRole('partner')) {
			$authority->deny('admin', 'User');
		}

		// loop through each of the users permissions, and create rules
		foreach($user->permissions as $permission) {
			if($permission->type == 'allow') {
				$authority->allow($permission->action, $permission->resource);
			} else {
				$authority->deny($permission->action, $permission->resource);
			}
		}
	}
);