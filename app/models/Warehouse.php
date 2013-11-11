<?php

class Warehouse extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	// See: http://www.developed.be/2013/08/30/laravel-4-pivot-table-example-attach-and-detach/
	// See also: http://johnveldboom.com/posts/5/working-with-data-in-pivot-tables-using-laravel-4-eloquent-orm
	// http://hitmyserver.net/laravel-4-pivot-table-data.html
	// http://stackoverflow.com/questions/15833335/how-to-make-my-own-timestamp-method-in-laravel
	public function products()
    {
        return $this->belongsToMany('Product')->withPivot('quantity')->withTimestamps();
    }
	
    public function stockmoves()
    {
        return $this->hasMany('Stockmove');
    }

}
