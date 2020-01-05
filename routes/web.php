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

//Route::get('/','Frontend\HomeController@index');
Auth::routes();
Route::get('/',function(){
	return view('frontend.index');
})->name('index');

Route::group([
	'prefix'=>'admin',
	'namespace'=>'Backend',
	'middleware'=>'auth'
],function(){
	Route::get('/','DashboardController@index')->name('backend.dashboard');

	Route::group([
		'prefix'=>'user',
		'namespace'=>'User'
	],function(){
		Route::get('/index','UserController@index')->name('backend.user.index');
		Route::get('/create','UserController@create')->name('backend.user.create');
		Route::get('/{id}','UserController@show')->name('backend.user.show');

		Route::get('products/{id}','UserController@showProducts')->name('backend.user.showProducts');

		Route::get('/test/{id}','UserController@test')->name('backend.user.test');
	});

	Route::group([
		'prefix'=>'product',
		'namespace'=>'Product'
	],function(){
		Route::get('/index','ProductController@index')->name('backend.product.index');
		Route::get('/create','ProductController@create')->name('backend.product.create');
		Route::get('/{id}','ProductController@show')->name('backend.product.show');
		Route::get('/orders/{id}','ProductController@showOrders')->name('backend.product.showOrders');
		
		Route::get('/images/{id}','ProductController@showImages')->name('backend.product.showImages');
	});

	Route::group([
		'prefix'=>'category',
		'namespace'=>'Category'
	],function(){
		Route::get('/index','CategoryController@index')->name('backend.category.index');
		Route::get('products/{id}','CategoryController@showProducts')->name('backend.category.showProducts');
	});

	Route::group([
		'prefix'=>'order',
		'namespace'=>'Order'
	],function(){
		Route::get('products/{id}','OrderController@showProducts')->name('backend.order.showProducts');
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
