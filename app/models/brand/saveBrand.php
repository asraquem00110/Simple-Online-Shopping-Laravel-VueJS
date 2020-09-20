<?php

namespace App\models\brand;

use App\models\brand\brand;

Class saveBrand {

	public function __construct(){

	}

	public function execute(array $data){
		$brand = new brand;
		$brand->brand = $data['brand'];
		$res = $brand->save() ? 1 : 0;
		return $res;
	}

}