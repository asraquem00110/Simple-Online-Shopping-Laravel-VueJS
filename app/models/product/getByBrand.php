<?php

namespace App\models\product;

use App\models\product\product;

Class getByBrand {

	public function __construct(){


	}


	public function execute($idno){
		$products = product::where('brand_id',$idno)->where('active',1)->paginate(10);
		return $products;
	}


}