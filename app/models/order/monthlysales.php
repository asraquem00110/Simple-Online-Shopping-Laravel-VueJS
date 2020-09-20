<?php

namespace App\models\order;

use App\models\order\order;
use DB;

Class monthlysales {

	public function __construct(){

	}

	public function execute(){
		$data = DB::table('orders')
				->leftjoin('order_product__pivot',function($join){
					$join->on('orders.id','=','order_product__pivot.order_id')
					->whereRaw('YEAR(orders.created_at) = YEAR(NOW())')
					->whereRaw('orders.status = 2')
				})
				->selectRaw('MONTH(orders.created_at) as monthdes','sum((order_product__pivot.amount*order_product__pivot.quantity) + orders.deliverycharge) as payment')
				->tosql();

		return $data;
	}

}