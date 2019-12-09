<?php

namespace App\Models\brand;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
     public function product(){
    	return $this->hasMany('App\models\product\product');
    }
}
