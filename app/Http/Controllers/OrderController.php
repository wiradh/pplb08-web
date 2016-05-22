<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

/**
* Kelas Controller yang mengatur alur Order, menampilkan order, melakukan order
* dan filtering order berdasarkan kriteria tertentu
*
* @author Putu Wira Astika Dharma
* @version 1/05/2016
*/
class OrderController extends Controller
{
    /*
    * Method untuk melakukan order
    */
    function order($type){
    	$token = \Request::input('token');

        // ekstraksi token menjadi user id dan username
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);
    	
    	$id_pelanggan = $user->id;
    	$jam_antar = \Request::input('jam_antar');
    	$jam_ambil = \Request::input('jam_ambil');
    	$longitude = \Request::input('longitude');
    	$latitude = \Request::input('latitude');
    	$tipe = \Request::input('tipe');
    	$id_penyedia = \Request::input('id_penyedia');
        $harga = \Request::input('harga');

        $detail_lokasi = \Request::input('detail_lokasi');

        $laundry = \App\Penyedia::where("id", "=", $id_penyedia)->first();
        
        $order = new \App\Order();
        $order->id_pelanggan = $id_pelanggan;
        $order->jam_antar = $jam_antar;
        $order->jam_ambil = $jam_ambil;
        $order->longitude = $longitude;
        $order->latitude = $latitude;
        $order->longitude_laundry = $laundry->longitude;
        $order->latitude_laundry = $laundry->latitude;
        $order->id_penyedia = $id_penyedia;
        $order->harga = $harga;
        $order->status = '0';
        $order->nama_pelanggan = $user->name;
        $order->nama_laundry = $laundry->nama;

        $order->detail_lokasi = $detail_lokasi;


        if($type == 'sandbox' || $order->save()) {
            return JSON_encode(['status' => '1']);
        }
    }

    /*
    * Mendapatkan order tertentu yang dilakukan terhadap satu penyedia tertentu
    */
    function getOrderByPenyedia($type){
    	$token = \Request::input('token');

        // ekstraksi token menjadi user id dan username
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);

    	$hasil = \App\Order::where("id_penyedia" , "=" , $user->id_penyedia)->get();
        if(count($hasil) == 0)
            return JSON_encode(['status' => '0']);

    	return JSON_encode(['status' => '1' , 'order' => $hasil]);

    }

    /*
    * Mendapatkan semua order pelanggan yang masih pending
    * Berguna untuk lelang order bagi para penyedia laundry
    */
    function getPendingOrder($type){
    	$token = \Request::input('token');

        // ekstraksi token menjadi user id dan username
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

    	$user = \App\User::where("id", "=", $data->id)->first();
    	if($user == '')
    		return JSON_encode(['status' => '0']);

    	$hasil = \App\Order::where("status" , "=" , "0")->get();
        if(count($hasil) == 0)
            return JSON_encode(['status' => '0']);

    	return JSON_encode(['status' => '1' , 'order' => $hasil]);

    }

    /*
    * mendapatkan order berdasarkan order id tertentu
    * berguna untuk menampilkan spesifik order tertentu
    */
    function getOrderById($type){
     	$id = \Request::input('order_id');
    	$token = \Request::input('token');

        // ekstraksi token menjadi user id dan username
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));


    	$hasil = \App\Order::where("id" , "=" , $id)->first();
        if($hasil == '')
            return JSON_encode(['status' => '0']);
        
    	return JSON_encode(['status' => '1' , 'order' => $hasil]);
    }

    /*
    * Mendapatkan semua order yang sudah tidk lagi pending
    * namun belum completed pada suatu pelanggan tertentu
    */
    function getActiveOrder($type) {
    	$token = \Request::input('token');

        // ekstraksi token menjadi user id dan username
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

        $pending = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '0')->get();

        $accepted = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '2')->get();

        $ongoing = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '3')->get();

        $done = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '4')->get();

        return JSON_encode(['status' => '1', 'pending' => $pending, 'accepted' => $accepted, 'ongoing' => $ongoing, 'done' => $done]);
    }

    /*
    * Mendapatkan order yang sudah selesai (history)
    * untuk satu pelanggan tertentu
    */
    function getCompletedOrder($type) {
    	$token = \Request::input('token');

        // ekstraksi token menjadi user id dan username
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

        $completed = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '5')->get();

        $canceled = \App\Order::where('id_pelanggan', '=', $data->id)->where('status', '=', '1')->get();

        return JSON_encode(['status' => '1', 'completed' => $completed, 'canceled' => $canceled, ]);
    }

    /*
    * Mendapatkan order order yang sudah dinyatakan selesai
    * namun bergantung pada order yang dilakukan suatu penyedia tertentu
    */
    function getCompletedOrderByPenyedia($type) {
    	$token = \Request::input('token');

        // ekstraksi token menjadi user id dan username
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));
        
        $user = \App\User::where("id", "=", $data->id)->first();

        $completed = \App\Order::where('id_penyedia', '=', $user->id_penyedia)->where('status', '=', '5')->get();

        $completed = \App\Order::where('id_penyedia', '=', $user->id_penyedia)->where('status', '=', '1')->get();

        return JSON_encode(['status' => '1', 'completed' => $completed, 'canceled' => $canceled]);
    }
    function setStatusOrderCancelByPengorder($type) {
        $token = \Request::input('token');

        // ekstraksi token menjadi user id dan username
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));
        
        $user = \App\User::where("id", "=", $data->id)->first();
        if($user == '')
            return JSON_encode(['status' => '0']);
        
        $id = \Request::input('order_id');

        $order = \App\Order::where('id', '=', $id)->first();

        $order->status = '-2';
        return JSON_encode(['status' => '1']);
    }


    /*
    * Method untuk merubah mekanisme pengambilan
    */
    function changeOrder($type){
        $token = \Request::input('token');

        // ekstraksi token menjadi user id dan username
        $data = JSON_decode(app('App\Http\Controllers\UserController')->getData($token));

        $user = \App\User::where("id", "=", $data->id)->first();
        if($user == '')
            return JSON_encode(['status' => '0']);
        
        $id_pelanggan = $user->id;
        $order_id = \Request::input('order_id');
        $jam_antar = \Request::input('jam_antar');
        $jam_ambil = \Request::input('jam_ambil');
        $tipe = \Request::input('tipe');
        
        $order = \App\Order::where("id", "=", $order_id)->first();
        if($order == '')
            return JSON_encode(['status' => '0']);

        $order->id_pelanggan = $id_pelanggan;
        $order->jam_antar = $jam_antar;
        $order->jam_ambil = $jam_ambil;
        //$order->tipe = $tipe;

        if($type == 'sandbox' || $order->save()) {
            return JSON_encode(['status' => '1']);
        }
    }

}
