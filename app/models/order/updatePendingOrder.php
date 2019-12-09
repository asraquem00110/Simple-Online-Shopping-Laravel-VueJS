<?php

namespace App\models\order;
use Str;
use App\models\order\order;


Class updatePendingOrder {

	public function __construct(){

	}

	public function execute(Array $data){
		$order = order::find($data['id']);
		$order->status = 1;
		$order->invoiceNo = "Invoice".Str::random(5).$data['id'];
		$order->orderNo = "Order".Str::random(5).$data['id'];
		$res = $order->save() ? 1 : 0;
		return $res;
	}

}