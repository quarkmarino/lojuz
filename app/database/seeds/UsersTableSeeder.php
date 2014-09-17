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
					'email' => 'matriz@lojuz.com',
					'password' => Hash::make('2515'),
					'status' => 1,
			));
			User::create(array(	
					'username' => 'quarkmarino',
					'email' => 'quarkmarino@gmail.com',
					'password' => Hash::make('2515'),
					'status' => 1,
			));
		}
	}

}