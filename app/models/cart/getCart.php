<?php

namespace App\models\cart;

use App\models\cart\cart;
use Auth;

Class getCart {
	public function __construct(){

	}

	public function execute(){
		//$Carts = Cart::with('product')->where('user_id',Auth::user()->id)->get();
		$Carts = cart::with('product')->whereRaw('user_id = ?',[Auth::user()->id])->get();
		// $items = [];

		// foreach($Carts as $cart){
		// 		$items[] = collect([
		// 			'id' => $cart->id,
		// 			'product' => $cart->product,
		// 			'quantity' => $cart->quantity,
		// 			'created_at' => $cart->created_at,
		// 			'updated_at' => $cart->updated_at,
		// 		]);
		// }

		return $Carts;
	}
}