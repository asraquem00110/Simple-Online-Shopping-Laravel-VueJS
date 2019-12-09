<?php


namespace App\models\product;

use App\models\product\product;

Class updateProduct {
	public function __construct(){

	}

	public function execute(array $data) {
		try{
			$product = product::find($data['id']);

			if($data['oldimg']!=NULL || $data['oldimg'] != ""){
			$oldimg = str_replace("../upload/", "", $data['oldimg']);
			unlink(public_path('upload').'/'.$oldimg);

			$filename =  time().'_'.$data['imgfile']->getClientOriginalName();

			$data['imgfile']->move(public_path('upload'),$filename);

			$product->product = $data['product'];
			$product->description = $data['description'];
			$product->price = $data['price'];
			$product->category_id = $data['category'];
			$product->brand_id = $data['brand'];
			$product->img = $filename;
	
			}else{
				$product->product = $data['product'];
				$product->description = $data['description'];
				$product->category_id = $data['category'];
				$product->brand_id = $data['brand'];
			}

			$product->save();
			return 1;
		}catch(Exception $e){
			return 0;
		}
	

	}

}