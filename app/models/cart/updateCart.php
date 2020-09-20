<?php

namespace App\models\cart;

use App\models\cart\cart;
use App\models\cart\cartDetail;
use Auth;

Class updateCart {

	private $cartdetail;

	public function __construct(cartDetail $CartDetail){
		$this->cartdetail = $CartDetail;
	}

	public function execute(Array $data){
		$productid = $data['product']['product_id'];
		$userid = Auth::user()->id;
		$quantity = $data['quantity'];
		$cartid = $data['product']['id'];

		$cart = cart::find($cartid);
		$cart->quantity = $quantity;
		$cart->save();

		$cartdetails = $this->cartdetail->execute($cart->id);
		return $cartdetails; 
		

	}

}