<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Models\Product;

class ProductsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$tags = $faker->words(7);
		//$tags = array('Enim', 'Incidunt','Doloribus', 'Non', 'Laudantium', 'Facere', 'Vero');

		foreach(range(1, 10) as $index)
		{
			Product::create(array(
				'catalog_id' => 1,
				'name' => $faker->word,
				'description' => $faker->sentence(3),
				'tags' => implode(', ', $faker->randomElements($tags, 3)),
				'type' => $faker->randomElement(array('product','service')),
				'price' => $faker->randomFloat(1, $min = 20, 100),
			));
		}
	}

}