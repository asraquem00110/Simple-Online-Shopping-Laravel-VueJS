<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\models\brand\brand;
use App\models\category\category;
use App\models\product\product;
use App\User;


Class DashboardController extends Controller {

		public function __construct(){
			//$this->middleware('auth:api');
		}

		public function index(){
			$brand = brand::All()->where('active',1)->count();
			$category = category::All()->where('active',1)->count();
			$product = product::All()->where('active',1)->count();
			$userlist = User::All();

			$data = [$brand,$category,$product,$userlist];
			return $data;
		}
}

?>