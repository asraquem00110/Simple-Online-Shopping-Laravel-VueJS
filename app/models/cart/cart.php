<?php

namespace App\models\cart;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    
    public function product() {
    	return $this->belongsTo('App\models\product\product');
    }
}
