<?php

namespace App\models\user;


use App\models\user\User;


Class saveNewUser {

	public function __construct(){

	}

	public function execute(Array $data){

		$user = new User;
		$user->name = $data['name'];
		$user->email = $data['email'];
		$user->userType = $data['type'];
		$user->address = $data['address'];
		$user->password = bcrypt($data['password']);
		$user->contact = $data['contact'];
		$res = $user->save() ? 1 : 0;
		return $res;
	}

}