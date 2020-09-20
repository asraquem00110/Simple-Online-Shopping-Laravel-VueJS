<?php

namespace App\models\product;

use App\models\product\product;

Class removeProduct {
	public function __construct(){

	}

	public function execute($idno){
		// $product = product::findorFail($idno);
		// $res = $product->delete() ? 1 : 0;
		// unlink(public_path('upload').'/'.$product->img);

		$product = product::find($idno);
		$product->active = 0;
		$res = $product->save() ? 1 : 0;
		return $res;
	}
}



?>