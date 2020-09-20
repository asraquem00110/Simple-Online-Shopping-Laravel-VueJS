<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\models\category\getAllCategory;
use App\models\category\saveCategory;
use App\models\category\removeCategory;
use App\models\category\getCategory;
use App\models\category\updateCategory;
use Illuminate\Http\Request;
use Validator;

Class CategoryController extends Controller {

	public function __construct(){
		
	}


	public function getAllCategory(getAllCategory $action){
		return response()->json(['categories'=>$action->execute()]);
	}

	public function saveNewCategory(Request $request,saveCategory $action){

		$rules = [
			'category' => 'required|unique:categories',
		];

		$Validator = Validator::make($request->all(),$rules);

		if($Validator->fails()){
			return response()->json(['errors'=> $Validator->getMessageBag()->toArray()]);
		}

		$message = $action->execute($request->all()) == 1 ? "Successfully Saved!" : "Something Went Wrong!";
		return response()->json(['message'=>$message]);
	}

	public function removeCategory($idno,removeCategory $action){
		$message = $action->execute($idno) == 1 ? "Successfully Removed!" : "Something Went Wrong!";
		return response()->json(['message'=>$message]);
	}

	public function getCategory($idno,getCategory $action){
		return response()->json($action->execute($idno));
	}

	public function updateCategory(Request $request,updateCategory $action){
		$message = $action->execute($request->all()) == 1 ? "Successfully Updated!" : "Something Went Wrong!";
		return response()->json(['message'=>$message]);
	}


}