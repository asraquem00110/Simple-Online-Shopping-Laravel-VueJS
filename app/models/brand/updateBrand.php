<?php

namespace App\models\brand;

use App\models\brand\brand;

Class updateBrand {

	public function __construct(){

	}

	public function execute(array $data){
		$newbrand = $data['brand'];
		$idno = $data['idno'];

		$_brand = brand::find($idno);
		$_brand->brand = $newbrand;
		$res = $_brand->save() ? 1 : 0;
		return $res;
	}
}