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
//home
//Route::get('/','HomeController@index');
Auth::routes();
//fiturbaru
Route::get('/','DassController@index');
Route::get('/covid','CovidController@index');
Route::get('/covid-dunia','CovidController@coviddunia');
Route::get('/covid-negara','CovidController@covidnegara');
Route::get('/covid-indoprov','CovidController@covidindoprov');
Route::get('/covidloadline/{info}','CovidController@line');
Route::get('/getcovid/{negara}','CovidController@getcovid');
Route::group(['middleware' => 'auth'], function () {
	//home
		Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
	//arimatika
		Route::get('/aritmatika','FiturbaruController@aritmatika');
		Route::get('/aritmatika-cari','FiturbaruController@aritmatika_cari');
	//geometri
		Route::get('/geometri','FiturbaruController@geometri');
		Route::get('/geometri-cari','FiturbaruController@geometri_cari');

});

