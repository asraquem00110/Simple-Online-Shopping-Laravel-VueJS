<?php 

namespace App\models\order;

use App\models\order\order;

Class getPendingOrders {

	public function __construct(){

	}

	public function execute(){
		$order = order::with(['product','user'])->where('status',0)->orderBy('id','DESC')->get();
		return $order;
	}
}