<?php

namespace App\models\order;
use Str;
use App\models\order\order;


Class updateDeliveredOrder {

	public function __construct(){

	}

	public function execute(Array $data){
		$order = order::find($data['id']);
		$order->status = 2;
		$res = $order->save() ? 1 : 0;
		return $res;
	}

}