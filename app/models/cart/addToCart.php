<?php

namespace App\models\cart;

use App\models\cart\cart;
use App\models\cart\cartDetail;
use Auth;

Class addToCart {
	private $cartdetail;
	public function __construct(cartDetail $CartDetail){
		$this->cartdetails = $CartDetail;
	}

	public function execute(array $data){

		$cart = cart::where('user_id',Auth::user()->id)->where('product_id',$data['id'])->first();

		if($cart){
			$cart->quantity = $cart->quantity + 1;
			$cart->save();
			
		}else{
			$cart = new cart;
			$cart->product_id = $data['id'];
			$cart->quantity = 1;
			$cart->user_id = Auth::user()->id;
			$cart->save();

			
		}

		$cartdetails = $this->cartdetails->execute($cart->id);
		return $cartdetails; 
		
		
	}

} 