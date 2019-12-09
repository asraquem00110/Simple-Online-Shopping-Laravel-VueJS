<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\cart\getCart;
use App\models\cart\addToCart;
use App\models\cart\updateCart;
use App\models\cart\removeCart;
use Validator;



Class CartController extends Controller {


	public function __construct(){

	}

	public function getCart(getCart $action){
		return response()->json(['cart'=>$action->execute()]);
	}

	public function addtoCart(Request $request,addToCart $action){

		$cartdetails = $action->execute($request->all());
		return response()->json(['cartdetails' => $cartdetails]);
		
	}

	public function updateCart(Request $request,updateCart $action){
		$response = $action->execute($request->all());
		return response()->json(['cart'=>$response]);
	}

	public function removeCart($idno,removeCart $action){
		$message = $action->execute($idno) == 1 ? "Successfully Removed!" : "Something Went Wrong!";
		return response()->json(['message'=>$message]);
	}

}
