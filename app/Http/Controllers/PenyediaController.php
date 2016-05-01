<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

/**
* Kelas Controller mengatur alur Penyedia Laundry
* dan fungsi fungsi yang berhubungan dengan Penyedia Laundry
*
* @author Putu Wira Astika Dharma
* @version 10/04/2016
*/
class PenyediaController extends Controller
{
    /*
    * mendapatkan list semua laundry
    */
    function getPenyedia($type) {
    	$laundry = \App\Penyedia::get();

    	return JSON_encode(['status' => '1', 'laundry' => $laundry]);
    }

    /*
    * Mengubah status order menjadi accepted
    * order tertentu berdsarkan orderid dan penyedia tertentu yang melakukan accept
    */
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

    /*
    * mengubah order menjadi statusnya jadi ongoing
    * sekaligus mengubah berat laundry pada order
    */
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
