<?php

namespace App\models\wishlist;
use App\models\wishlist\wishlist;

Class removeWish {
    public function __construct(){

    }

	public function execute($idno){
		$wish = wishlist::findorFail($idno);
		$res = $wish->delete() ? 1 : 0;
		return $res;
	}
}