<?php

namespace App\models\product;

use App\models\product\product;

Class saveProduct {
	public function __construct(){

	}

	public function execute(array $data){
		$name = $data['product'];
		$description = $data['description'];
		$category = $data['category'];
		$brand = $data['brand'];
		$price = $data['price'];
		$filename =  time().'_'.$data['imgfile']->getClientOriginalName();

		try {
			$data['imgfile']->move(public_path('upload'),$filename);
			$product = new product;
			$product->product = $name;
			$product->description = $description;
			$product->category_id = $category;
			$product->brand_id = $brand;
			$product->img = $filename;
			$product->price = $price;
			$product->save();
			return 1;
		}catch (Exception $e){
			return 0;
		}
		


	}

}