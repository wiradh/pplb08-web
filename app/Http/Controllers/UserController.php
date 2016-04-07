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
        return \View::make('user/login');
    }

    function postLogin() {
        $credentials = \Request::only('name', 'password');
        $remember = \Request::has('remember');
        if (\Auth::attempt($credentials, $remember)) {
            return \Redirect::to('/getAllUser');
        } else {
            $msg = "Password atau Username salah";
            return \View::make('user/login')->with(compact('msg'));
        }
    }

    function logout() {
        \Auth::logout();
        return \Redirect::to('login');
    }
}
