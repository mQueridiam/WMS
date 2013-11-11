<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('layouts.master');
});

Route::get('warehouses/{id}/products', 'WarehousesController@indexProducts');

Route::get('warehouses/{id}/stockmoves', 'WarehousesController@indexStockmoves');

Route::resource('warehouses', 'WarehousesController');

Route::get('products/{id}/warehouses', 'ProductsController@indexWarehouses');

Route::get('products/{id}/stockmoves', 'ProductsController@indexStockmoves');

Route::resource('products', 'ProductsController');

/* ********************************************************** */

Route::get('test', function()
{
	$wh_id = 21; // 21, 22
	$p_id = 1;   // 1, 2, 3

	$wh = Warehouse::find($wh_id);
	// $wh->products()->attach($p_id); //this executes the insert-query
	   $wh->products()->attach($p_id, array('quantity' => 1)); //this executes the insert-query with quantity = 1

	// $wh->products()->detach($p_id); //this executes the delete-query on the pivot table

	echo 'So far, so good';
});

Route::resource('stockmoves', 'StockmovesController');