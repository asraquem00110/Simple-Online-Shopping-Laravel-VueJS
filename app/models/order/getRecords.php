<?php 

namespace App\models\order;

use App\models\order\order;

Class getRecords {

	public function __construct(){

	}

	public function execute(){
		$order = order::with(['product','user'])->where('status','>',1)->orderBy('id','DESC')->paginate(10);
		return $order;
	}
}