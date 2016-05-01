<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    function order($type){
    	$token = \Request::input('token');

        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);
    	
    	$id_pelanggan = $user->id;
    	$jam_antar = \Request::input('jam_antar');
    	$jam_ambil = \Request::input('jam_ambil');
    	$longtitude = \Request::input('longtitude');
    	$lattitude = \Request::input('lattitude');
    	$tipe = \Request::input('tipe');
    	$id_penyedia = \Request::input('id_penyedia');
        
        $order = new \App\Order();
        $order->id_pelanggan = $id_pelanggan;
        $order->jam_antar = $jam_antar;
        $order->jam_ambil = $jam_ambil;
        $order->longtitude = $longtitude;
        $order->lattitude = $lattitude;
        $order->id_penyedia = $id_penyedia;
        $order->status = '0';

        if($type == 'sandbox' || $order->save()) {
            return JSON_encode(['status' => '1']);
        }
    }
    function getOrderByPenyedia($type){
    	$id_penyedia = \Request::input('id_penyedia');
    	$token = \Request::input('token');

        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);

    	$hasil = \App\Order::where("id_penyedia" , "=" , $id_penyedia)->get();
        if(count($hasil) == 0)
            return JSON_encode(['status' => '0']);

    	return JSON_encode(['status' => '1' , 'order' => $hasil]);

    }

    function getPendingOrder($type){
    	$token = \Request::input('token');

        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);

    	$hasil = \App\Order::where("status" , "=" , "0")->get();
        if(count($hasil) == 0)
            return JSON_encode(['status' => '0']);

    	return JSON_encode(['status' => '1' , 'order' => $hasil]);

    }
    function getOrderById($type){
     	$id = \Request::input('id');
    	$token = \Request::input('token');

        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);

    	$hasil = \App\Order::where("id_penyedia" , "=" , $id)->first();
        if($hasil == '')
            return JSON_encode(['status' => '0']);
        
    	return JSON_encode(['status' => '1' , 'order' => $hasil]);
    }

    function getActiveOrder($type) {
    	$token = \Request::input('token');
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

        $pending = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '0')->get();

        $accepted = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '2')->get();

        $ongoing = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '3')->get();

        $done = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '4')->get();

        return JSON_encode(['status' => '1', 'pending' => $pending, 'accepted' => $accepted, 'ongoing' => $ongoing, 'done' => $done]);
    }

    function getCompletedOrder($type) {
    	$token = \Request::input('token');
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

        $completed = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '5')->get();

        return JSON_encode(['status' => '1', 'completed' => $completed]);
    }

    function getCompletedOrderByPenyedia($type) {
    	$token = \Request::input('token');
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));
        $user = \App\User::where("id", "=", $data->id)->first();

        $completed = \App\Order::where('id_penyedia', '=', $user->id_penyedia)->where('status', '=', '5')->get();

        return JSON_encode(['status' => '1', 'completed' => $completed]);
    }
}
