<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;


    public function user()
	{
	   	return $this->belongsTo('App\User','user_id','id');
	}

	public function area()
	{
	   	return $this->belongsTo('App\Area','area_id','id');
	}

	public function subcategory()
	{
	   	return $this->belongsTo('App\Subcategory','subcategory_id','id');
	}

	public function brand()
	{
	   	return $this->belongsTo('App\Brand','brand_id','id');
	}

}

