<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
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
