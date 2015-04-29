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
	Route::get('payment/finish', ['as' => 'frontend.payment.finish', 'uses' => 'PaymentController@finish']);
	Route::get('payment/unfinish', ['as' => 'frontend.payment.unFinish', 'uses' => 'PaymentController@finish']);
	Route::get('payment/error', ['as' => 'frontend.payment.error', 'uses' => 'PaymentController@finish']);
});