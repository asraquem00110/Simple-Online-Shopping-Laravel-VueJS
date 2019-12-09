<?php

namespace App\models\category;
use App\models\category\category;

Class saveCategory {

	public function __construct(){

	}

	public function execute(array $data){
		$Category = new category;
		$Category->category = $data['category'];
		$res = $Category->save() ? 1 : 0;
		return $res;
	}
}