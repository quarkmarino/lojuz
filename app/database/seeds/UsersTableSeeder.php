<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Models\User;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 1) as $index)
		{
			User::create(array(	
					'username' => 'admin',
					'email' => 'admin@lojuz.com',
					'password' => Hash::make('25152835bb'),
					'status' => 1,
			));
		}
	}

}