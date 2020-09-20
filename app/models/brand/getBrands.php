<?php

namespace App\models\brand;

use App\models\brand\brand;

Class getBrands {

	public function __construct(){

	}

	public function execute(){
		$brands = brand::where('active',1)->OrderBy('brand')->paginate(100);
		return $brands;
	}

}