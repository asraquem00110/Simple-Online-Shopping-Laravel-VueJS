<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware'=>'auth:api'],function(){



	Route::group(['middleware'=>'admin'],function(){
			
			Route::get('/getDashboardDetails','DashboardController@index');

			Route::post('/SaveCategory','CategoryController@saveNewCategory');
			Route::delete('/removeCategory/{idno}','CategoryController@removeCategory');
			Route::get('/getCategory/{idno}','CategoryController@getCategory');
			Route::patch('/UpdateCategory','CategoryController@updateCategory');


		
			Route::post('/saveBrand','BrandController@saveBrand');
			Route::delete('/removeBrand/{idno}','BrandController@removeBrand');
			Route::get('/getBrand/{idno}','BrandController@getBrand');
			Route::patch('/UpdateBrand','BrandController@UpdateBrand');

			Route::post('/saveProduct','ProductController@saveProduct');
			
			Route::delete('/removeProduct/{idno}','ProductController@removeProduct');
			Route::post('/updateProduct','ProductController@updateProduct');


			Route::get('/getAdminList','UserController@getAdminList');

			Route::get('/getAdminBySearch/{search}','UserController@getAdminBySearch');

			Route::get('/getCustomerList','UserController@getCustomerList');

			Route::get('/getCustomerBySearch/{search}','UserController@getCustomerBySearch');
			
			Route::delete('/removeUser/{idno}','UserController@removeUser');

			Route::post('/saveNewUser','UserController@saveNewUser');

			Route::get('/getUserInfo/{idno}','UserController@getUserInfo');

			Route::patch('/changePassword','UserController@changePassword');

			Route::patch('/updateUser','UserController@updateUser');

			Route::get('/getPendingOrders','OrderController@getPendingOrders');

			Route::get('/getDeliveryOrders','OrderController@getDeliveryOrders');

			Route::get('/getRecords','OrderController@getRecords');

			Route::post('/updatePendingOrder','OrderController@updatePendingOrder');

			Route::post('/updateDeliveredOrder','OrderController@updateDeliveredOrder');

			Route::get('/monthlysales','OrderController@monthlysales');

			Route::get('/AdminorderSearch/{search}','OrderController@AdminorderSearch');

			Route::post('/showdataMonthly','OrderController@showdataMonthly');

			Route::post('/showdataYearly','OrderController@showdataYearly');
	});

Route::post('/getCart','CartController@getCart');

Route::post('/logout','Api\AuthController@logout')->name('user.logout');

Route::get('/getUserDetails',function(){
	return 'hello world';
});

Route::post('/addtocart','CartController@addtoCart');

Route::post('/addtowishlist','CartController@addtowishlist');

Route::delete('/removewishlist/{idno}','CartController@removewishlist');

Route::get('/getwishlist','CartController@getwishlist');

Route::patch('/updateCart','CartController@updateCart');

Route::delete('/removeCart/{idno}','CartController@removeCart');

Route::post('/createOrderCOD','OrderController@createOrderCOD');

Route::post('/createOrderPay','OrderController@createOrderPay');

Route::get('/getUserOrders','OrderController@getUserOrders');

Route::get('/orderSearch/{query}','OrderController@orderSearch');


});



Route::post('/create-payment','OrderController@createpayment');

Route::post('/execute-payment','OrderController@executepayment');


Route::get('/getProducts','ProductController@getProducts');
Route::get('/getBrands','BrandController@getBrands');
Route::get('/getCategories','CategoryController@getAllCategory');

Route::get('/getByCategory/{idno}','ProductController@getByCategory');

Route::get('/getByBrand/{idno}','ProductController@getByBrand');

Route::get('/getBySearch/{query}','ProductController@getBySearch');

Route::post('/register','Api\AuthController@register')->name('user.register');
Route::post('/login','Api\AuthController@login')->name('user.login');
