<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockmovesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stockmoves', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date');
			$table->string('document');
			$table->decimal('price');
			$table->integer('quantity');
			
			$table->integer('product_id')->unsigned()->nullable(false);
			$table->integer('warehouse_id')->unsigned()->nullable(false);
			
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stockmoves');
	}

}
