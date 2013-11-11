<?php

class Stockmove extends Eloquent {
	protected $table = 'stockmoves';
	
	protected $guarded = array();

	public static $rules = array(
		'document' => 'required',
		'price' => 'required',
		'quantity' => 'required'
	);
	
    // See: http://stackoverflow.com/questions/12941397/laravel-eloquent-one-to-many-relationships
	public function product()
    {
        return $this->belongsTo('Product');
	}
	
    public function warehouse()
    {
        return $this->belongsTo('Warehouse');
	}
}
