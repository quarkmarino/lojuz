<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Models\Gallery;

class GalleriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 1) as $index)
		{
			Gallery::create(array(
				'user_id' => 1,
				'name' => 'Gallery 1',
				'tags' => implode(', ', $faker->words(3)),
				'description' => $faker->sentence(3),
				'status' => 1
			));
		}
	}

}