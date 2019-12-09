<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('shop.index');
});

// Route::group(['middleware'=>'admin'],function(){
// 	Route::get('/admin',function(){
// 		return view('admin.index');
// 	});
// });

// Route::get('/admin/login',function(){
// 	return view('admin.login');
// });

Route::get('/admin',function(){
	return view('admin.index');
});

Route::get('/access-denied',function(){
	return view('accessDenied');
});


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/testing',function(){
	$user = new App\models\user\User;
	echo "<pre>";
	var_dump($user->index());

});


Route::post('/formSubmit','AppController@uploadtest');


Route::get('/{route}','AppController@show')->where('route','^(?!api).*$')->name('administrator');

