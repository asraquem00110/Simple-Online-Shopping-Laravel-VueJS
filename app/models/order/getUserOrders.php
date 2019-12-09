<?php 

namespace App\models\order;

use App\models\order\order;
use Auth;

Class getUserOrders {

	public function __construct(){

	}

	public function execute(){
		$order = order::with(['product','user'])->where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10);
		return $order;
	}
}