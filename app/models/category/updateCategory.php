<?php

namespace App\models\category;
use App\models\category\category;
use App\models\category\getCategory;


Class updateCategory {
	//private $getCategory;

	public function __construct(getCategory $getCategory){
		//$this->getCategory = $getCategory;
	}

	public function execute(array $data){
		$newcategory = $data['category'];
		$idno = $data['idno'];
		$_category = category::find($idno);
		$_category->category = $newcategory;
		$res = $_category->save() ? 1 : 0;
		return $res;
	}

}