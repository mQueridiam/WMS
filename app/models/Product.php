<?php

class Product extends Eloquent {

	protected $guarded = array();

	public static $rules = array();
	
	public function warehouses()
    {
        return $this->belongsToMany('Warehouse')->withPivot('quantity')->withTimestamps();
    }
	
    public function stockmoves()
    {
        return $this->hasMany('Stockmove');
    }
}
