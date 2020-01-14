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
Route::get('/test','HomeController@test');
Route::group([
	'namespace'=>'Frontend'
],function(){
	Route::group([
		'prefix'=>'product',
		'namespace'=>'Product'
	],function(){
		Route::get('/{id}','ProductController@show')->name('frontend.product.show');
	});


});
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

		Route::post('/','UserController@store')->name('backend.user.store');
		
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
		Route::post('','ProductController@store')->name('backend.product.store');

		Route::get('/edit/{product}','ProductController@edit')->name('backend.product.edit')->middleware('can:update,product');
		
		Route::match(['put','patch'],'/{id}','ProductController@update')->name('backend.product.update');

		Route::get('/{id}','ProductController@show')->name('backend.product.show');
		Route::get('/orders/{id}','ProductController@showOrders')->name('backend.product.showOrders');
		Route::delete('/{id}','ProductController@destroy')->name('backend.product.delete');
		Route::get('/images/{id}','ProductController@showImages')->name('backend.product.showImages');
		
		Route::get('/test','ProductController@test');
	});

	Route::group([
		'prefix'=>'category',
		'namespace'=>'Category'
	],function(){
		Route::get('/index','CategoryController@index')->name('backend.category.index');
		Route::get('/create','CategoryController@create')->name('backend.category.create');
		Route::post('/','CategoryController@store')->name('backend.category.store');

		Route::get('/edit/{id}','CategoryController@edit')->name('backend.category.edit');
		Route::match(['put','patch'],'/{id}','CategoryController@update')->name('backend.category.update');

		Route::delete('/{id}','CategoryController@destroy')->name('backend.category.delete');

		Route::get('products/{id}','CategoryController@showProducts')->name('backend.category.showProducts');
	});

	Route::group([
		'prefix'=>'order',
		'namespace'=>'Order'
	],function(){
		Route::get('products/{id}','OrderController@showProducts')->name('backend.order.showProducts');
	});
});

Route::get('/home', 'HomeController@index')->name('home');