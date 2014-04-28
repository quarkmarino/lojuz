<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Models\Image;

class ImagesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 3) as $index)
		{
			Image::create(array(
				'product_id' => 1,
				'name' => $faker->word,
				'status' => 1,
			));
		}
	}

}