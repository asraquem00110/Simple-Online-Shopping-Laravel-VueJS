<?php

namespace App\models\wishlist;
use App\models\wishlist\wishlist;
use Auth;

Class removeWish {
    public function __construct(){

    }

	public function execute($idno){
		$wish = wishlist::where("user_id",Auth::User()->id)->where("product_id",$idno);
		$res = $wish->delete() ? 1 : 0;
		return $res;
	}
}
