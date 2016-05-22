<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\CustomerPackage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
* Kelas Controller mengatur flow terkhusus untuk User
* Login, Register, getData, details, dll
*
* @author Putu Wira Astika Dharma
* @version 10/04/2016
*/
class UserController extends Controller
{
    /*
    * Extraksi token menjadi Data userid dan username
    * digunakan untuk semua API
    */
    public static function getData($token) {
        $username = app('App\Http\Controllers\ApiController')->getUsername($token);
        $iduser = app('App\Http\Controllers\ApiController')->getId($token);

        return JSON_encode(['id' => $iduser, 'username' => $username]);
    }

    /*
    * melakukan konversi dari user id dan username menjadi sebuah token
    */
    public static function getToken($user, $id) {
        $str = $user."7890$".$id."0987";
        $token = app('App\Http\Controllers\ApiController')->encrypt($str, 1409199511041995);
        return $token;
    }

    /*
    * mendapatkan details user tertentu
    */
    function getDetails($type) {
        $token = \Request::input('token');

        $data = JSON_decode($this->getData($token));

        $user = \App\User::where("id", "=", $data->id)->first();

        if($user == "") return JSON_encode(['status' => '0']);

        return JSON_encode(['status' => '1', 'user' => $user]);
    }

    /*
    * fungsi login, menggunaan (username atau email) dan password
    */
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

    /*
    * Fungsi register pelanggan baru
    */
    function register($type) {
        $name = \Request::input('name');
        $email = \Request::input('email');
        $password = \Request::input('password');
        $nomor_hp = \Request::input('nomor_hp');

        $user = new \App\User();
        $user->name = $name;

        $user2 = \App\User::where("name", "=", $name)->first();
        if($user2 != "") 
            return JSON_encode(['status' => '0']);

        $user->email = $email;
        $user->nomor_hp = $nomor_hp;
        $user->role = "CU"; //PELANGGAN
        $user->remember_token = "";
        $user->password = \Hash::make('password');

        if($type == "sandbox" || $user->save()) {
            $token = $this->getToken($user->name, $user->id);
            return JSON_encode(['status' => '1', 'token' => $token]);
        }

        return JSON_encode(['status' => '0']);
    }
    
    function setDetails($type) {
        $token = \Request::input('token');

        $data = JSON_decode($this->getData($token));

        $user = \App\User::where("id", "=", $data->id)->first();

        if($user == "") return JSON_encode(['status' => '0']);

        $nama = \Request::input('nama');
        $alamat = \Request::input('alamat');
        $foto = \Request::input('foto');
        
        $user->nama = $nama;
        $user->alamat = $alamat;
        $user->foto = $foto;


        return JSON_encode(['status' => '1']);
    }


}
