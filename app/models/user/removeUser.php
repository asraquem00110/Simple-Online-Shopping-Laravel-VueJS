<?php

namespace App\models\user;

use App\models\user\User;


Class removeUser {

	public function __construct(){

	}

	public function execute($idno){
		$user = User::findorFail($idno);
		$user->accessToken()->delete();
		$res = $user->delete() ? 1 : 0;
		return $res;
	}
}