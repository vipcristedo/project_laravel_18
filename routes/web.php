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

Route::get('/','Frontend\HomeController@index');
Route::group([
	'prefix'=>'admin',
	'namespace'=>'Backend'
],function(){
	Route::get('/','DashboardController@index')->name('backend.dashboard');

	Route::group([
		'prefix'=>'user',
		'namespace'=>'User'
	],function(){
		Route::get('/index','UserController@index')->name('backend.user.index');
		Route::get('/create','UserController@create')->name('backend.user.create');
	});

	Route::group([
		'prefix'=>'product',
		'namespace'=>'Product'
	],function(){
		Route::get('/index','ProductController@index')->name('backend.product.index');
		Route::get('/create','ProductController@create')->name('backend.product.create');
	});

	Route::group([
		'prefix'=>'category',
		'namespace'=>'Category'
	],function(){
		Route::get('/index','CategoryController@index')->name('backend.category.index');
	});
});
