<?php

namespace App\models\user;


use App\models\user\User;


Class getAdminList {

		public function __construct(){

		}


		public function execute(){
			$users = User::where('userType',1)->paginate(10);
			return $users;
		}


}