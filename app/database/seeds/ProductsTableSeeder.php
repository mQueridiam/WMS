<?php

class ProductsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('products')->truncate();

		$products = array(
			array('name' => 'Fagodio Esforulante', 'price' => 50.0),
			array('name' => 'Junta de Trócola', 'price' => 70.0),
			array('name' => 'Super-Charger', 'price' => 90.0),
		);

		// Uncomment the below to run the seeder
		DB::table('products')->insert($products);
	}

}
