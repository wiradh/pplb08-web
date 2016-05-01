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
Route::get('/', function() {return 'forbidden';});

Route::get('/docs', 'ApiController@documentation');
Route::get('/docs/logout', 'ApiController@logout');

// API ROUTES
Route::get('/api/getData/{token}', 'UserController@getData');

Route::post('/{type}/login/', 'UserController@login');
Route::post('/{type}/register/', 'UserController@register');
Route::post('/{type}/getDetails/', 'UserController@getDetails');

Route::post('/{type}/acceptOrder/', 'PenyediaController@acceptOrder');
Route::post('/{type}/takeOrder/', 'PenyediaController@takeOrder');
Route::post('/{type}/getLaundry/', 'PenyediaController@getPenyedia');

Route::post('/{type}/getActiveOrder/', 'OrderController@getActiveOrder');
Route::post('/{type}/getCompletedOrder/', 'OrderController@getCompletedOrder');

Route::post('/{type}/getCompletedOrderByPenyedia/', 'OrderController@getCompletedOrderByPenyedia');