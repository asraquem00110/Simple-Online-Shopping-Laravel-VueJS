<?php

namespace App\models\category;
use App\models\category\category;

Class removeCategory {

	public function __construct(){

	}

	public function execute($idno){
		// $category = Category::findorFail($idno);
		// $res = $category->delete() ? 1 : 0;
		$category = category::find($idno);
		$category->active = 0;
		$res = $category->save() ? 1 : 0;
		return $res;
	}
}