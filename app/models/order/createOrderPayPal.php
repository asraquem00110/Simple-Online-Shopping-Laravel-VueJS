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


Class createOrderPayPal {

	public function __construct(){

	}

	public function execute(Array $data){
			$deliverycharge = $data['deliverycharge'];
			$deliverycharge = 0;

		  $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            trim(env('PAYPAL_CLIENTID')),     // ClientID
            trim(env('PAYPAL_SECRETKEY'))      // ClientSecret
	        )
	    );

		 	$payer = new Payer();
		    $payer->setPaymentMethod("paypal");

		      $details = new Details();
			  $details->setShipping(0)
			        ->setTax(0)
			        ->setSubtotal(($data['computeTotal']+$deliverycharge));

		    $amount = new Amount();
		    $amount->setCurrency("USD")
		        ->setTotal(($data['computeTotal']+$deliverycharge))
		        ->setDetails($details);;

		    $transaction = new Transaction();
		    $transaction->setAmount($amount)
		        ->setDescription("Payment description")
		        ->setInvoiceNumber(uniqid());


		    $redirectUrls = new RedirectUrls();
		    $redirectUrls->setReturnUrl("http://laravel-paypal-example.test")
		        ->setCancelUrl("http://laravel-paypal-example.test");

		    // Add NO SHIPPING OPTION
		    $inputFields = new InputFields();
		    $inputFields->setNoShipping(1);

		    $webProfile = new WebProfile();
		    $webProfile->setName($data['name'] . uniqid())->setInputFields($inputFields);

		    $webProfileId = $webProfile->create($apiContext)->getId();

		    $payment = new Payment();
		    $payment->setExperienceProfileId($webProfileId); // no shipping
		    $payment->setIntent("sale")
		        ->setPayer($payer)
		        ->setRedirectUrls($redirectUrls)
		        ->setTransactions(array($transaction));

		    try {
		        $payment->create($apiContext);
		    } catch (Exception $ex) {
		        echo $ex;
		        exit(1);
		    }

		    return $payment;
		


	}

}