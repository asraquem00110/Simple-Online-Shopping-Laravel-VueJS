<?php

namespace App\models\wishlist;
use App\models\wishlist\wishlist;
use Auth;

Class addToWish {
    public function __construct(){
		
    }
    
    public function execute(array $data){
        $check = wishlist::where("product_id",$data["id"])->where("user_id",Auth::user()->id)->count();
        if($check == 0){
            $wish = new wishlist;
            $wish->product_id = $data["id"];
            $wish->user_id = Auth::user()->id;
            $wish->save();
        }
        return $check;
    }
}
