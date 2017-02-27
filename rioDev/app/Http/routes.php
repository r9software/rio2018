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

Route::get('/', 'HomeController@index')->name('login');
Route::get('/twitter_login', 'HomeController@twitterLogin')->name('twitter_login');
Route::post('/facebook_login', 'HomeController@facebookLogin')->name('facebook_login');
/*CMS */
Route::get('/admin', 'AdminController@index')->name('admin_login');
Route::post('/admin/login', 'AdminController@login')->name('admin_ajax');
Route::get('/admin/home', 'AdminController@home')->name('home_admin');
Route::get('/admin/descargar', 'AdminController@descargar')->name('descargar'); 
/*Sync*/
Route::get('/api/generate','APIController@generar')->name('generar');
Route::get('/api/{key}/sync','APIController@sincronizar')->name('sincronizar');
Route::get('/api/status','APIController@status')->name('status');
Route::any('/api/resetStep','APIController@reiniciarPaso')->name('reset_step');
Route::any('/api/updateStatus','APIController@actualizarStatus')->name('update_status');
Route::any('/api/nextStep','APIController@siguientePaso')->name('next_step');