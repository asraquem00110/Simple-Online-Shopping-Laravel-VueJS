<?php

namespace App\models\user;

use App\models\user\User;


Class getUserInfo {

	public function __construct(){

	}

	public function execute($idno){
		$user = User::where('id',$idno)->first();
		return $user;
	}

}