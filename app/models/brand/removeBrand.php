<?php

namespace App\models\brand;

use App\models\brand\brand;

Class removeBrand {

	public function __construct(){

	}

	public function execute($idno){
		// $brand = brand::findorFail($idno);
		// $res = $brand->delete() ? 1 : 0;

		$brand = brand::find($idno);
		$brand->active = 0;
		$res = $brand->save() ? 1 : 0;
		return $res;
	}

}