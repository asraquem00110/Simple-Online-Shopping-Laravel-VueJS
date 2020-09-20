<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\brand\saveBrand;
use App\models\brand\getBrands;
use App\models\brand\removeBrand;
use App\models\brand\getBrand;
use App\models\brand\updateBrand;
use Validator;


Class BrandController extends Controller {

	public function __construct(){

	}

	public function saveBrand(Request $request,saveBrand $action){

		$rules = [
			'brand' => 'required|unique:brands',
		];

		// custom validation message
		$message = [
			'required' => 'the :attribute field is needed',
			'unique' => 'the :attribute already exist',
		];

		$validator = Validator::make($request->all(),$rules,$message);

		if($validator->fails()){
			return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
		}
		
		$message = $action->execute($request->all()) == 1 ? "Successfully Saved!" : "Something Went Wrong!";
		return response()->json(['message'=>$message]);
	}

	public function getBrands(getBrands $action){
		return response()->json(['brands'=>$action->execute()]);
	}

	public function removeBrand($idno,removeBrand $action){
		$message = $action->execute($idno) == 1 ? "Successfully Removed!" : "Something Went Wrong!";
		return response()->json(['message'=>$message]);
	}

	public function getBrand($idno,getBrand $action){
		return response()->json($action->execute($idno));
	}

	public function UpdateBrand(Request $request,updateBrand $action){
		$message = $action->execute($request->all()) == 1 ? "Successfully Updated!" : "Something Went Wrong!";
		return response()->json(['message'=>$message]);
	}

}