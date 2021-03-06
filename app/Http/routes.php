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

// TOKEN RELATED ROUTES
Route::get('/api/getData/{token}', 'UserController@getData');

// API ROUTES
Route::post('/{type}/login/', 'UserController@login');
Route::post('/{type}/register/', 'UserController@register');
Route::post('/{type}/getDetails/', 'UserController@getDetails');
Route::post('/{type}/setDetails/', 'UserController@setDetails');

Route::post('/{type}/order/', 'OrderController@order');
Route::post('/{type}/getOrderByPenyedia/', 'OrderController@getOrderByPenyedia');
Route::post('/{type}/getOrderById/', 'OrderController@getOrderById');
Route::post('/{type}/getPendingOrder/', 'OrderController@getPendingOrder');


Route::post('/{type}/changeOrder/', 'PenyediaController@changeOrder');
Route::post('/{type}/getLaundry/', 'PenyediaController@getPenyedia');
Route::post('/{type}/getDetailsLaundry/', 'PenyediaController@getDetails');

Route::post('/{type}/getActiveOrder/', 'OrderController@getActiveOrder');
Route::post('/{type}/getCompletedOrder/', 'OrderController@getCompletedOrder');
Route::post('/{type}/getCompletedOrderByPenyedia/', 'OrderController@getCompletedOrderByPenyedia');
Route::post('/{type}/setStatusOrderCancelByPengorder/', 'OrderController@setStatusOrderCancelByPengorder');

Route::post('/{type}/changePengambilanOrder/', 'OrderController@changePengambilanOrder');

Route::get('/page/help/', function() {return "ini adalah helppage, sisanya akan kami edit lebih lanjut";});