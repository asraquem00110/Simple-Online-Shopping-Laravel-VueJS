<?php

namespace App\models\category;
use App\models\category\category;

Class getAllCategory {

	public function __construct(){

	}

	public function execute(){
		$categories = category::where('active',1)->OrderBy('category')->paginate(100);
		return $categories;
	}
}