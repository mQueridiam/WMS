<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotProductWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_warehouse', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned()->index();
			$table->integer('warehouse_id')->unsigned()->index();
			$table->integer('quantity')->default(0);
			
			$table->timestamps();
			
			
			// Generated:
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			$table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
			// Also see: http://johnveldboom.com/posts/5/working-with-data-in-pivot-tables-using-laravel-4-eloquent-orm
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_warehouse');
	}

}
