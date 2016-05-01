<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PenyediaController extends Controller
{
    function getPenyedia($type) {
    	$laundry = \App\Penyedia::get();

    	return JSON_encode(['status' => '1', 'laundry' => $laundry]);
    }

    function acceptOrder($type) {
    	$order_id = \Request::input('order_id');
    	$token = \Request::input('token');

    	$data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();

    	$order = \App\Order::where("id_penyedia", "=", $user->id_penyedia)->where("id", "=", $order_id)->first();

    	if($order == "") {
    		return JSON_encode(['status' => '0']);
    	}

    	$order->status = '2';

    	if($type == "sandbox" || $order->save()) {
            return JSON_encode(['status' => '1']);
        }


    	return JSON_encode(['status' => '0']);
    }

    function takeOrder($type) {
    	$order_id = \Request::input('order_id');
    	$berat = \Request::input('berat');
    	$token = \Request::input('token');

    	$data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();

    	$order = \App\Order::where("id_penyedia", "=", $user->id_penyedia)->where("id", "=", $order_id)->first();

    	if($order == "") {
    		return JSON_encode(['status' => '0']);
    	}

    	$order->status = '3';
    	$order->berat = $berat;


    	if($type == "sandbox" || $order->save()) {
            return JSON_encode(['status' => '1']);
        }


    	return JSON_encode(['status' => '0']);
    }
}
