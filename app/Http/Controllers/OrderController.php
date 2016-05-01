<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    public function order($type){
    	$token = \Request::input('token');

        $data = JSON_decode($this->getData($token));

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
    public function getOrderByPenyedia($type){
    	$id_penyedia = \Request::input('id_penyedia');
    	$token = \Request::input('token');

        $data = JSON_decode($this->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);

    	$hasil = \App\Order::where("id_penyedia" , "=" , $id_penyedia)->get();
        if(count($hasil) == 0)
            return JSON_encode(['status' => '0']);

    	return JSON_encode(['status' => '1' , 'order' => $hasil]);

    }

    public function getPendingOrder($type){
    	$token = \Request::input('token');

        $data = JSON_decode($this->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);

    	$hasil = \App\Order::where("status" , "=" , "0")->get();
        if(count($hasil) == 0)
            return JSON_encode(['status' => '0']);

    	return JSON_encode(['status' => '1' , 'order' => $hasil]);

    }
     public function getOrderById($type){
     	$id = \Request::input('id');
    	$token = \Request::input('token');

        $data = JSON_decode($this->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);

    	$hasil = \App\Order::where("id_penyedia" , "=" , $id)->first();
        if($hasil == '')
            return JSON_encode(['status' => '0']);
    	return JSON_encode(['status' => '1' , 'order' => $hasil]);
    }
}
