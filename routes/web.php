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
    return \redirect('login');
});
Auth::routes([
	'register' => false, // Registration Routes...
  	'reset' => false, // Password Reset Routes...
  	'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::resource('kriteria', 'KriteriaController');
	Route::post('kriteria/update/{id}', 'KriteriaController@update');

	Route::get('kriteria/{id}/subkriteria', 'SubKriteriaController@index');
	Route::get('kriteria/{id}/subkriteria/create', 'SubKriteriaController@create');
	Route::post('subkriteria/store/{id}', 'SubKriteriaController@store');
	Route::get('subkriteria/destroy/{id}', 'SubKriteriaController@destroy');

	Route::get('alternatif', 'AlternatifController@index');	
	Route::get('det_alternatif/{id}', 'AlternatifController@det_alternatif');	

	Route::get('perhitungan', 'PerhitunganController@index');

	Route::get('data_jalan', 'AlternatifController@dataJalan');	
	Route::get('updateAlternatif/{id}', 'AlternatifController@update');	

});

