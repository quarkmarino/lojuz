<?php

class Role_UserTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('role_user')->truncate();

		$roles_users = array(
			array(
				'user_id' => 1,
				'role_id' => 1,
			),
			array(
				'user_id' => 2,
				'role_id' => 1,
			),
		);

		// Uncomment the below to run the seeder
		DB::table('role_user')->insert($roles_users);
	}

}
