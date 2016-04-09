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

// API ROUTES
Route::get('/api/getData/{token}', 'UserController@getData');
Route::post('/api/login/', 'UserController@login');
Route::post('/api/register/', 'UserController@register');