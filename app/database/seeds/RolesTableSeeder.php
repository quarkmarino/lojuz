<?php

class RolesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('roles')->truncate();

		$roles = array(
			array(
				'name' => 'admin',
				'created_at' => 'CURRENT_TIMESTAMP',
				'updated_at' => 'CURRENT_TIMESTAMP'
			),
		);

		// Uncomment the below to run the seeder
		DB::table('roles')->insert($roles);
	}

}
