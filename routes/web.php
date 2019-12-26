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

Route::get('/','Backend\DashboardController@index');
Route::group([
	'prefix'=>'admin',
	'namespace'=>'Backend'
],function(){
	Route::get('/dashboard','DashboardController@index')->name('backend.dashboard');
	Route::get('/user/index','UserController@index')->name('backend.user.index');
	Route::get('/user/create','UserController@create')->name('backend.user.create');
	Route::get('/product/index','ProductController@index')->name('backend.product.index');
	Route::get('/product/create','ProductController@create')->name('backend.product.create');
	Route::get('/category/index','CategoryController@index')->name('backend.category.index');
});
