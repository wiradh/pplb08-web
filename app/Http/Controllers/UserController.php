<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\CustomerPackage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public static function getData($token) {
        $username = app('App\Http\Controllers\ApiController')->getUsername($token);
        $iduser = app('App\Http\Controllers\ApiController')->getId($token);

        return JSON_encode(['id' => $iduser, 'username' => $username]);
    }

    public static function getToken($user, $id) {
        $str = $user."7890$".$id."0987";
        $token = app('App\Http\Controllers\ApiController')->encrypt($str, 1409199511041995);
        return $token;
    }

    function getDetails($type) {
        $token = \Request::input('token');

        $data = JSON_decode($this->getData($token));

        $user = \App\User::where("id", "=", $data->id)->first();

        return JSON_encode($user);
    }

    function login($type) {        
        $credentials = \Request::only('name', 'password');
        $remember = \Request::has('remember');
        if (\Auth::attempt($credentials, $remember)) {
            $token = $this->getToken(\Auth::user()->name, \Auth::user()->id);
            return JSON_encode(['status' => '1', 'token' => $token]);
        }

        $credentials = \Request::only('email', 'password');
        if (\Auth::attempt($credentials, $remember)) {
            $token = $this->getToken(\Auth::user()->name, \Auth::user()->id);
            return JSON_encode(['status' => '1', 'token' => $token]);
        }

        $msg = "Password atau Username salah";
        return JSON_encode(['status' => '0']);
    }

    function register($type) {
        $name = \Request::input('name');
        $email = \Request::input('email');
        $password = \Request::input('password');

        $user = new \App\User();
        $user->name = $name;

        $user2 = \App\User::where("name", "=", $name)->first();
        if($user2 != "") 
            return JSON_encode(['status' => '0']);

        $user->email = $email;
        $user->role = "CU";
        $user->remember_token = "";
        $user->password = \Hash::make('password');

        if($type == "sandbox" || $user->save()) {
            $token = $this->getToken($user->name, $user->id);
            return JSON_encode(['status' => '1', 'token' => $token]);
        }

        return JSON_encode(['status' => '0']);
    }


}
