<?php

namespace App\models\user;

use App\models\user\User;

Class changePassword {

	public function __construct(){

	}

	public function execute(Array $data){
		$user = User::find($data['id']);
		$user->password = bcrypt($data['password']);
		$res = $user->save() ? 1 : 0;
		return $res;
	}

}