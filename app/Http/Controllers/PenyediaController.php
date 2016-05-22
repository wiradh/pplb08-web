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
    * mengubah status order
    * sekaligus mengubah berat laundry pada order
    */
    function changeOrder($type) {
    	$order_id = \Request::input('order_id');
    	$berat = \Request::input('berat');
        $status = \Request::input('status');
    	$token = \Request::input('token');

    	$data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();

    	$order = \App\Order::where("id", "=", $order_id)->first();

    	if($order == "") {
    		return JSON_encode(['status' => '0']);
    	}

    	$order->status = $status;
        if($status == "2" || $status == "3") $order->id_penyedia = $user->id_penyedia);
    	if($berat != "" && $berat != null) $order->berat = $berat;


    	if($type == "sandbox" || $order->save()) {
            return JSON_encode(['status' => '1']);
        }


    	return JSON_encode(['status' => '0']);
    }

    function getDetails($type) {
        $token = \Request::input('token');
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));
        $user = \App\User::where("id", "=", $data->id)->first();
        if($user == "") {
            return JSON_encode(['status' => '0']);
        }       

        $id = \Request::input('id_penyedia');
        $penyedia = \App\Penyedia::where("id", "=" , $id)->first();
        if($penyedia == ""){
            return JSON_encode(['status' => '0']);
        }

        return JSON_encode(['status' => '0' , 'penyedia' => $penyedia]);
    }

}
