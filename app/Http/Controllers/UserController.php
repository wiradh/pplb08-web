<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\CustomerPackage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    function login() {        
        $credentials = \Request::only('name', 'password');
        $remember = \Request::has('remember');
        if (\Auth::attempt($credentials, $remember)) {
            return JSON_encode(['status' => '1']);
        }

        $credentials = \Request::only('email', 'password');
        if (\Auth::attempt($credentials, $remember)) {
            return JSON_encode(['status' => '1']);
        }

        $msg = "Password atau Username salah";
        return JSON_encode(['status' => '0']);
    }

    function register() {
        $name = \Request::input('name');
        $email = \Request::input('email');
        $password = \Request::input('password');

        $user = new \App\User();
        $user->name = $name;
        $user->email = $email;
        $user->password = \Hash::make('password');

        if($user->save())
            return JSON_encode(['status' => '1']);

        return JSON_encode(['status' => '0']);
    }
}
