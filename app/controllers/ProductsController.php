<?php

class ProductsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $products = Product::orderBy('name', 'ASC')->get();
        return View::make('products.index')->with('products', $products);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('products.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$rules = array('name' => 'required');

		$v = Validator::make($input, $rules);

		if ($v->passes())
		{
			$product = new Product;
			$product->name = Input::get('name');
			$product->price_cost = 0.0;
			$product->quantity_total = 0.0;
			$product->active = Input::get('active');
			$product->save();

			return Redirect::route('products.index');
		}

		return Redirect::back()->withInput()->withErrors($v);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('products.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $product = Product::find($id);

        if (is_null($product)) 
        {
        	return Redirect::route('products.index');
        }

        return View::make('products.edit')->with('product', $product);
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

		$rules = array('name' => 'required');

		$v = Validator::make($input, $rules);

		if ($v->passes())
		{
			Product::find($id)->update($input);

			return Redirect::route('products.index');
		}

		return Redirect::back()->withInput()->withErrors($v);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Product::find($id)->delete();

		return Redirect::route('products.index');

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexWarehouses($id)
	{
        $product = Product::find($id);

        if (is_null($product)) 
        {
        	return Redirect::route('products.index');
       	}

        return View::make('products.indexWarehouses')->with(array('product' => $product, 'warehouses' => $product->warehouses));
	}
	
	public function indexStockmoves($id)
	{
        $product = Product::find($id);

        if (is_null($product)) 
        {
        	return Redirect::route('products.index');
       	}

        return View::make('products.indexStockmoves')->with(array('product' => $product, 'stockmoves' => $product->stockmoves));
	}

}
