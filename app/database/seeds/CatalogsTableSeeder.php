<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Models\Catalog;

class CatalogsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Catalog::create(array(
				'user_id' => 1,
				'name' => $faker->word,
				'tags' => implode(', ', $faker->words(3)),
				'description' => $faker->sentence(3),
				'status' => 1
			));
		}
	}

}