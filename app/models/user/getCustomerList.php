<?php

namespace App\models\user;


use App\models\user\User;


Class getCustomerList  {

		public function __construct(){

		}


		public function execute(){
			$users = User::where('userType',0)->paginate(10);
			return $users;
		}


}