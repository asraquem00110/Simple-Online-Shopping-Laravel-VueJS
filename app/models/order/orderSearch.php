<?php

namespace App\models\order;

use App\models\order\order;
use Auth;

Class orderSearch {

	public function __construct(){

	}

	public function execute($orderID){
		$orders = order::with(['product','user'])->where('id','LIKE',$orderID."%")->where('user_id',Auth::User()->id)->paginate(10);
		return $orders;

	}

}
