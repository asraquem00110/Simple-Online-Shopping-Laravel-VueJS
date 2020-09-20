<?php

namespace App\Models\category;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
      public function product(){
    	return $this->hasMany('App\models\product\product');
    }
}
