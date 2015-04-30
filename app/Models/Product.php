<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	public function item()
	{
		return $this->hasMany('App\Models\ProductItem');
	}

}
