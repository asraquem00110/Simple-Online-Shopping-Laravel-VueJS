<?php

namespace App\models\cart;

use App\models\cart\cart;

Class cartDetail {

	public function __construct(){


	}

	public function execute($id){
		$cartdetails = cart::with('product')->where('id',$id)->get();
		return $cartdetails; 
	}

}