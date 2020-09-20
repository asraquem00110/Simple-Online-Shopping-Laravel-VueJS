<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\models\user\getAdminList;
use App\models\user\getCustomerList;
use App\models\user\removeUser;
use App\models\user\saveNewUser;
use App\models\user\getUserInfo;
use App\models\user\changePassword;
use App\models\user\updateUser;
use App\models\user\getAdminBySearch;
use App\models\user\getCustomerBySearch;

use Validator;

Class UserCOntroller extends Controller {

		public function __construct(){


		}

		public function getAdminList(getAdminList $action){
				return response()->json(['users' => $action->execute()]);
		}

		public function getAdminBySearch($search,getAdminBySearch $action){
			return response()->json(['users' => $action->execute($search)]);
		}

		public function getCustomerList(getCustomerList $action){
				return response()->json(['users' => $action->execute()]);
		}

		public function getCustomerBySearch($search,getCustomerBySearch $action){
			return response()->json(['users' => $action->execute($search)]);
		}

		public function removeUser($idno,removeUser $action){
				$message = $action->execute($idno) == 1 ? "Successfully Removed!" : "Something Went Wrong!";
				return response()->json(['message'=>$message]);
		}

		public function saveNewUser(Request $request,saveNewUser $action){

			$rules = [
	    		'name' => 'required|max:55',
	    		'email' => 'email|required|unique:users',
	    		'password' => 'required|confirmed',
	            'address' => 'required',
	            'contact' => 'required|numeric',
	    	];

	    	$validator = Validator::make($request->all(),$rules);

	    	if($validator->fails()){
	    		return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
	    	}	

	    	$message = $action->execute($request->all()) == 1 ? "Successfully Saved!" : "Something Went Wrong!";
	    	return response()->json(['message'=>$message]);

		}

		public function getUserInfo($idno,getUserInfo $action){
			return response()->json(['user'=> $action->execute($idno)]);
		}

		public function changePassword(Request $request,changePassword $action){

			$rules = [
				'password' => 'required|confirmed',
			];

			$validator = Validator::make($request->all(),$rules);

			if($validator->fails()){
				return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
			}

			$message = $action->execute($request->all()) == 1 ? "Password Changed" : "Something Went Wrong!";
	    	return response()->json(['message'=>$message]);
		}

		public function updateUser(Request $request,updateUser $action){
			$rules = [
	    		'name' => 'required|max:55',
	    		// 'email' => 'email|required|unique:users',
	            'address' => 'required',
	            'contact' => 'required|numeric',
	    	];


	    	$validator = Validator::make($request->all(),$rules);

	    	if($validator->fails()){
	    		return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
	    	}	

	    	$message = $action->execute($request->all()) == 1 ? "Details Updated!" : "Something Went Wrong!";
	    	return response()->json(['message'=>$message]);
		}




}