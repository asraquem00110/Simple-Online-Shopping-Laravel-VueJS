<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\user\User;
use App\models\oauth_access_token;
use Auth;
use DB;
use Validator;


Class AuthController extends Controller{

	public function register(Request $request){
		$data = [
    		'name' => 'required|max:55',
    		'email' => 'email|required|unique:users',
    		'password' => 'required|confirmed',
            'address' => 'required',
            'contact' => 'required|numeric',
    	];

    	$validator = Validator::make($request->all(),$data);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->getMessageBag()->toArray()]); 
    	}


    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
        $user->address = $request->address;
        $user->contact = $request->contact;
    	$user->password = bcrypt($request->password);
    	$user->save();

    	return response()->json(['message'=>'Successfully registered']);

	}

	public function login(Request $request){

    	$data = [
    		'email' => 'email|required',
    		'password' => 'required',
    	];

    	$validator = Validator::make($request->all(),$data);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->getMessageBag()->toArray()]); 
    	}


    	if(!auth()->attempt($request->all())){
    		return response()->json(['message'=> 'invalid credentials']);
    	}


    	$accessToken = Auth()->user()->createToken('authToken')->accessToken;
    	return response()->json(['user'=>Auth()->user(),'access_token'=>$accessToken]);

    }


    public function logout(){
        $user = Auth::user()->token();
        $user->revoke();
       
       // // logout from all device
       //Auth::user()->accessToken()->delete();

      // $oauth_access_token = oauth_access_token::where('user_id',Auth::user()->id);
       // $oauth_access_token->delete();

       return redirect('/admin');
    }


    public function getUser(){
    	return Auth()->user();
    }




}