<?php

namespace App\models\cart;

use App\models\cart\cart;

Class removeCart {
	public function __construct(){

	}

	public function execute($idno){
		$category = cart::findorFail($idno);
		$res = $category->delete() ? 1 : 0;
		return $res;
	}
}