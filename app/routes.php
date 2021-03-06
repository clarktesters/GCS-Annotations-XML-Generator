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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('dashboard', array('before' => 'auth', 'uses' => 'HomeController@showDashboard'));

// Confide RESTful route
Route::get('user/confirm/{code}', 'UserController@getConfirm');
Route::get('user/reset/{token}', 'UserController@getReset');
Route::controller( 'user', 'UserController');
Route::group(array('prefix' => 'api/v1', 'before' => 'auth.api'), function()
{
	Route::resource('sites', 'SitesController');
	Route::resource('searches', 'SearchesController');
});

Route::get('searches/{search_id}.xml', 'XmlController@show');