<?php

namespace App\models\user;

use App\models\user\User;

Class updateUser {

	public function __construct(){

	}

	public function execute(Array $data){
		$user = User::find($data['id']);
		$user->name = $data['name'];
		$user->address = $data['address'];
		$user->contact = $data['contact'];
		$user->userType = $data['type'];
		$res = $user->save() ? 1 : 0;
		return $res;
	}

}