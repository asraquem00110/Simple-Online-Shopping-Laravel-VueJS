<?php

namespace App\models\order;

use App\models\order\order;
use App\models\order\insertItems;
use App\models\cart\clearCart;
use Auth;


Class createOrderPay {
	private $insertItems;
	private $clearCart;

	public function __construct(insertItems $insertItems,clearCart $clearCart){
		$this->insertItems = $insertItems;
		$this->clearCart = $clearCart;
	}

	public function execute(Array $data){
			
		$order = new order;
		$order->user_id = Auth::user()->id;
		$order->name = $data['name'];
		$order->email = $data['email'];
		$order->address = $data['address'];
		$order->payment = "PAY";
		$order->contact = $data['contact']; 
		$order->deliverycharge = $data['deliverycharge'];
		$order->orderNo = $data['paypalData']['id'];
		$order->invoiceNo = "paypal_".$data['paypalData']['transactions'][0]['invoice_number'];
		$order->save();

	    $this->insertItems->execute($order,$data['items']);

	    return $this->clearCart->execute();


	}

}