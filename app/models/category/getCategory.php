<?php

namespace App\models\category;
use App\models\category\category;

Class getCategory {

	public function __construct(){

	}

	public function execute($idno){
		$category = category::whereRaw('id = ?',[$idno])->get();
		return $category;
	}
}