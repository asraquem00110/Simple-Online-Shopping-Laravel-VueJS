<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{

	public static $validation = [


	];

    public function brand(){
    	return $this->belongsTo('App\models\brand\brand');
    }

    public function category(){
    	return $this->belongsTo('App\models\category\category');
    }

    public function order(){
    	return $this->belongsToMany('App\models\order\order','order_product__pivot')->withPivot('quantity','amount');
    }

    public function cart(){
        return $this->hasMany('App\models\cart\cart');
    }


}
