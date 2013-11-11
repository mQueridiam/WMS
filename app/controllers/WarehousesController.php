<?php

class WarehousesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $whs = Warehouse::orderBy('name', 'ASC')->get();
        return View::make('warehouses.index')->with('warehouses', $whs);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('warehouses.create');
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
			$wh = new Warehouse;
			$wh->name = Input::get('name');
			$wh->save();

			return Redirect::route('warehouses.index');
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
        return View::make('warehouses.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $wh = Warehouse::find($id);

        if (is_null($wh)) 
        {
        	return Redirect::route('warehouses.index');
        }

        return View::make('warehouses.edit')->with('warehouse', $wh);
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
			Warehouse::find($id)->update($input);

			return Redirect::route('warehouses.index');
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
		Warehouse::find($id)->delete();

		return Redirect::route('warehouses.index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexProducts($id)
	{
        $wh = Warehouse::find($id);

        if (is_null($wh)) 
        {
        	return Redirect::route('warehouses.index');
       	}

        return View::make('warehouses.indexProducts')->with(array('warehouse' => $wh, 'products' => $wh->products));
	}
	
	public function indexStockmoves($id)
	{
        $wh = Warehouse::find($id);

        if (is_null($wh)) 
        {
        	return Redirect::route('warehouses.index');
       	}

        return View::make('warehouses.indexStockmoves')->with(array('warehouse' => $wh, 'stockmoves' => $wh->stockmoves));
	}

}
