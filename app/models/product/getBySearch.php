<?php

namespace App\models\product;

use App\models\product\product;

Class getBySearch {
	public function __construct(){


	}


	public function execute($query){

		$products = product::with(['brand','category'])->where('active',1)->where('product','LIKE', $query.'%')->paginate(10);
		return $products;

	}


}