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
/* CMS */
Route::get('/admin', 'AdminController@index')->name('admin_login');
Route::post('/admin/login', 'AdminController@login')->name('admin_ajax');
Route::get('/admin/home', 'AdminController@home')->name('home_admin');
Route::get('/admin/descargar', 'AdminController@descargar')->name('descargar');
/* Sync */
Route::get('/api/generate', ['middleware' => 'cors', 'uses' => 'APIController@generar'])->name('generar');
Route::get('/api/{key}/sync', ['middleware' => 'cors', 'uses' => 'APIController@sincronizar'])->name('sincronizar');
Route::get('/api/status', ['middleware' => 'cors', 'uses' => 'APIController@status'])->name('status');
Route::any('/api/resetStep', ['middleware' => 'cors', 'uses' => 'APIController@reiniciarPaso'])->name('reset_step');
Route::any('/api/updateStatus', ['middleware' => 'cors', 'uses' => 'APIController@actualizarStatus'])->name('update_status');
Route::any('/api/nextStep', ['middleware' => 'cors', 'uses' => 'APIController@siguientePaso'])->name('next_step');
