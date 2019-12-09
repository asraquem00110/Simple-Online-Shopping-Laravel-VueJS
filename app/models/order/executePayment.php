<?php

namespace App\models\order;

use App\models\order\order;


use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

Class executePayment {

	public function __construct(){

	}

	public function execute(Array $data){
			$apiContext = new \PayPal\Rest\ApiContext(
			        new \PayPal\Auth\OAuthTokenCredential(
			            trim(env('PAYPAL_CLIENTID')),     // ClientID
			            trim(env('PAYPAL_SECRETKEY'))      // ClientSecret
				        )
				    );


		    $paymentId = $data['paymentID'];
		    $payment = Payment::get($paymentId, $apiContext);

		    $execution = new PaymentExecution();
		    $execution->setPayerId($data['payerID']);

		    try {
		        $result = $payment->execute($execution, $apiContext);
		    } catch (Exception $ex) {
		        echo $ex;
		        exit(1);
		    }


		    return $result;
	}
}




?>