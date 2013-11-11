<?php

class ProductsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('products')->truncate();

		$products = array(
			array('name' => 'Fagodio Esforulante', 'price_cost' => 50.0),
			array('name' => 'Junta de Trócola', 'price_cost' => 70.0),
			array('name' => 'Super-Charger', 'price_cost' => 90.0),
		);

		// Uncomment the below to run the seeder
		DB::table('products')->insert($products);
	}

}
