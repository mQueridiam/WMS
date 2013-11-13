<?php

class StockmovesController extends BaseController 
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $sms = Stockmove::orderBy('created_at', 'ASC')->get();
        return View::make('stockmoves.index')->with('stockmoves', $sms);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$whList = Warehouse::lists('name', 'id');

		return View::make('stockmoves.create')->with('whList', $whList);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, StockMove::$rules);

		if ($validation->passes())
		{
			// START Laravel transaction
			
			// Save Stock movement
			$stockmove = new Stockmove;
			$stockmove->date = Input::get('date');
			$stockmove->document = Input::get('document');
			$stockmove->price = Input::get('price');
			$stockmove->quantity = Input::get('quantity');
			$stockmove->product_id = Input::get('product_id');
			$stockmove->warehouse_id = Input::get('warehouse_id');
			$stockmove->save();
			//$stockmove->create($input);
			
			// Update Product (price_cost -average- & quantity_total)
			$product = Product::find($stockmove->product_id);
			$quantity_total = $product->quantity_total + $stockmove->quantity;
			if ($quantity_total != 0)
				$product->price_cost = ($product->quantity_total*$product->price_cost + $stockmove->quantity*$stockmove->price) / ($product->quantity_total + $stockmove->quantity);
			$product->quantity_total = $quantity_total;
			$product->save();
			
			// Update Product-Warehouse relationship (quantity)
			$whs = $product->warehouses;
			if ($whs->contains($stockmove->warehouse_id)) {
				$wh = $product->warehouses()->get();
				$wh = $wh->find($stockmove->warehouse_id);
				$quantity = $wh->pivot->quantity + $stockmove->quantity;
				
				if ($quantity != 0) {
					// Update - See: http://dezkareid.wordpress.com/2013/07/25/relacion-manytomany-y-tablas-pivot-con-laravel-4/
					$wh->pivot->quantity = $quantity;
					$wh->pivot->save(); }
				else {
					// Delete
					$product->warehouses()->detach($stockmove->warehouse_id); }
			} else {
				// See: http://forums.laravel.io/viewtopic.php?id=1270
				$product->warehouses()->attach($stockmove->warehouse_id, array('quantity' => $stockmove->quantity));
			}
			
			
			
			// END Laravel transaction

			return Redirect::route('stockmoves.index');
		}

		return Redirect::route('stockmoves.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$stockmove = $this->stockmove->findOrFail($id);

		return View::make('stockmoves.show', compact('stockmove'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$stockmove = $this->stockmove->find($id);

		if (is_null($stockmove))
		{
			return Redirect::route('stockmoves.index');
		}

		return View::make('stockmoves.edit', compact('stockmove'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, StockMove::$rules);

		if ($validation->passes())
		{
			$stockmove = $this->stockmove->find($id);
			$stockmove->update($input);

			return Redirect::route('stockmoves.show', $id);
		}

		return Redirect::route('stockmoves.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->stockmove->find($id)->delete();

		return Redirect::route('stockmoves.index');
	}

}
