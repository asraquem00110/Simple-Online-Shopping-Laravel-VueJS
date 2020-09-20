<?php 

namespace App\models\order;

use App\models\order\order;

Class getDeliveryOrders {

	public function __construct(){

	}

	public function execute(){
		$order = order::with(['product','user'])->where('status',1)->orderBy('id','DESC')->get();
		return $order;
	}
}