<?php

namespace App\models\wishlist;

use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    //

    public function product(){
        return $this->belongsTo('App\models\product\product');
    }
}
