<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model {

	public function item()
	{
		return $this->belongsTo('App/Models/Product');
	}

}
