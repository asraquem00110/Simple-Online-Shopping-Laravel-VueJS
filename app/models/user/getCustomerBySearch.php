<?php

namespace App\models\user;


use App\models\user\User;


Class getCustomerBySearch {

		public function __construct(){

		}


		public function execute($search){
			$users = User::where('userType',0)->where('name','LIKE',$search."%")->paginate(10);
			return $users;
		}


}