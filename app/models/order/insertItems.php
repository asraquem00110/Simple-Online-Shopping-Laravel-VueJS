<?php

namespace App\models\order;

use App\models\order\order;


Class insertItems {

	public function __construct(){

	}

	public function execute(order $order,Array $items){

		try {
			foreach($items as $item){
				if(!$order->product->contains($item['product_id'])){
					$order->product()->attach($item['product_id'],[
						'quantity'=> $item['quantity'], 
						'amount' => $item['product']['price'],
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
					]);
				}
			}
			return 1;
		}catch (Exception $e){
			return 0;
		}
	
	
	}


}