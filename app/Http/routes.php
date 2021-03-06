<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['namespace' => 'Frontend'], function(){
	Route::get('/', ['as' => 'frontend.home', 'uses' => 'HomeController@index']);
	Route::get('detail', ['as' => 'frontend.detail', 'uses' => 'DetailController@index']);
	Route::get('cart', ['as' => 'frontend.cart', 'uses' => 'CartController@index']);
	Route::get('cart/add', ['as' => 'frontend.cart.add', 'uses' => 'CartController@add']);
	Route::post('cart/update_all', ['as' => 'frontend.cart.updateAll', 'uses' => 'CartController@updateAll']);
	Route::get('cart/remove/{rowId}', ['as' => 'frontend.cart.remove', 'uses' => 'CartController@remove']);
	Route::get('cart/add/destroy', ['as' => 'frontend.cart.destroy', 'uses' => 'CartController@destroy']);
	Route::get('checkout', ['as' => 'frontend.checkout', 'uses' => 'CheckoutController@index']);
	Route::post('checkout/pay', ['as' => 'frontend.checkout.pay', 'uses' => 'CheckoutController@pay']);
	Route::get('payment/finish', ['as' => 'frontend.payment.finish', 'uses' => 'PaymentController@finish']);
	Route::get('payment/unfinish', ['as' => 'frontend.payment.unFinish', 'uses' => 'PaymentController@finish']);
	Route::get('payment/error', ['as' => 'frontend.payment.error', 'uses' => 'PaymentController@finish']);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function(){
	Route::get('/', ['as' => 'backend.dashboard', 'uses' => 'DashboardController@index']);
	Route::get('product', ['as' => 'backend.product', 'uses' => 'ProductController@index']);
	Route::get('product/create', ['as' => 'backend.product.create', 'uses' => 'ProductController@create']);
	Route::post('product/create', ['as' => 'backend.product.store', 'uses' => 'ProductController@store']);
	Route::get('product/edit/{id}', ['as' => 'backend.product.edit', 'uses' => 'ProductController@edit']);
});