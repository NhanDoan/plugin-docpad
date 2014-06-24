<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'SiteController@index'));
Route::post('getRates', array('uses' => 'SiteController@getRates', 'as' => 'getRates'));
Route::get('getValoanNews', 'SiteController@getValoanNews');
Route::get('getVeteranNews', 'SiteController@getVeteranNews');


// Route::get('/', function()
// {
// 	return View::make('site/index');
// });
