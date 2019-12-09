<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\product\saveProduct;
use App\models\product\getProducts;
use App\models\product\removeProduct;
use App\models\product\updateProduct;
use App\models\product\getByCategory;
use App\models\product\getByBrand;
use App\models\product\getBySearch;
use Validator;


Class ProductController extends Controller {

	public function __construct(){
		 // $this->middleware('auth');
	}

	public function saveProduct(Request $request,saveProduct $action){
		
		$rules = [
			'product' => 'required',
			'description' => 'required',
			'price' => 'required|numeric',
			'category' => 'required',
			'brand' => 'required',
			'imgfile' => 'required',
		];

		$validator = Validator::make($request->all(),$rules);

		if($validator->fails()){
			return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
		}


		$message = $action->execute($request->all()) == 1 ? "Successfully Saved!" : "Something Went Wrong!";
		return response()->json(['success'=>$message]);
	}

	public function updateProduct(Request $request,updateProduct $action){
		

		$rules = [
			'product' => 'required',
			'description' => 'required',
			'category' => 'required',
			'brand' => 'required',
			'price' => 'required|numeric',
		];


		$validator = Validator::make($request->all(),$rules);

		if($validator->fails()){
			return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
		}

		$message = $action->execute($request->all()) == 1 ? "Successfully Updated!" : "Something Went Wrong!";
		return response()->json(['success'=>$message]);

		
	}

	public function getProducts(getProducts $action){
		return response()->json(['products'=>$action->execute()]);
	}

	public function removeProduct($idno,removeProduct $action){
		$message = $action->execute($idno) == 1 ? "Successfully Removed!" : "Something Went Wrong!";
		return response()->json(['message'=>$message]);
	}

	public function getByCategory($idno,getByCategory $action){
		return response()->json(['products'=> $action->execute($idno)]);
	}

	public function getByBrand($idno,getByBrand $action){
		return response()->json(['products'=> $action->execute($idno)]);
	}

	public function getBySearch($query,getBySearch $action){
		return response()->json(['products'=> $action->execute($query)]);
	}
}

?>
