<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Api\Auth\LoginController@login');
Route::post('register', 'Api\Auth\RegisterController@register');
// Route::post('validator', 'Api\Auth\RegisterController@validator');
// Route::post('forgetPassword', 'Api\Auth\UserController@forgetPassword');

Route::middleware('auth:api')->group(function () {
	Route::get('data', 'Api\MetodeController@index');
	Route::post('inputData', 'Api\MetodeController@input');
	Route::post('dataJalan', 'Api\MetodeController@dataJalan');
});