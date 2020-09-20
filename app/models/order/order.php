<?php

namespace App\Models\order;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public function product(){
    	return $this->belongsToMany('App\models\product\product','order_product__pivot')->withPivot('quantity','amount');
    }

    public function user(){
    	return $this->belongsTo('App\models\user\User');
    }
}
