<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('Role_UserTableSeeder');
		//$this->call('GalleriesTableSeeder');
		//$this->call('CatalogsTableSeeder');
		//$this->call('ProductsTableSeeder');
		//$this->call('ImagesTableSeeder');
	}

}