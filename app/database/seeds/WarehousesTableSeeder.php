<?php

class WarehousesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('warehouses')->truncate();

		$warehouses = array(
			array('name' => 'General'),
			array('name' => 'WEB'),
		);

		// Uncomment the below to run the seeder
		DB::table('warehouses')->insert($warehouses);
	}

}
