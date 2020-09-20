<?php

namespace App\models\wishlist;
use App\models\wishlist\wishlist;
use Auth;

class getwishlist {

    public function __construct(){

    }

    public function execute(){
        $data = wishlist::with(["product"=> function($query){
            $query->with("category");
            $query->with("brand");
        }])
        ->leftJoin("products","product_id","products.id")
        ->where("user_id",Auth::user()->id)
        ->orderBy("products.product","ASC")
        ->get();
        return $data;
    }
}