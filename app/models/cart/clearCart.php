<?php

namespace App\models\cart;

use App\models\cart\cart;
use Auth;
Class clearCart {

	public function __construct(){

	}

	public function execute(){

		try {
			$cart = cart::where('user_id',Auth::user()->id)->delete();
			return 1;
		}catch(Exception $e){
			return 0;
		}
		

	}

}