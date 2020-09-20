<?php

namespace App\models\product;

use App\models\product\product;

Class getProducts {
	public function __construct(){

	}

	public function execute(){
		$products = product::with(['brand','category'])->where('active',1)->OrderBy('product')->paginate(12);
		return $products;
	}
}