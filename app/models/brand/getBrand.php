<?php

namespace App\models\brand;

use App\models\brand\brand;

Class getBrand {

	public function __construct(){

	}

	public function execute($idno){
		$brand = brand::WhereRaw('id = ?',[$idno])->get();
		return $brand;
	}

}