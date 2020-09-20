<?php

namespace App\models\product;

use App\models\product\product;

Class getByCategory {

	public function __construct(){


	}


	public function execute($idno){
		$products = product::with(['brand','category'])->where('category_id',$idno)->where('active',1)->paginate(10);
		return $products;
	}


}