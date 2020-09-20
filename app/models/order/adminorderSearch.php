<?php

namespace App\models\order;

use App\models\order\order;

Class adminorderSearch {

	public function __construct(){

	}

	public function execute($orderID){
		$orders = order::with(['product','user'])->where('id','LIKE',$orderID."%")->paginate(10);
		return $orders;

	}

}