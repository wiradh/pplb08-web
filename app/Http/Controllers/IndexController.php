<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\CustomerPackage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    function halo() {
        return \View::make('index/index');
    }


    function getAllUser() {
        $user = \App\User::get();

        return \View::make('index/halo')->with(compact('user'));
    }

    function details($id) {
        return "idnya adalah : " . $id;
    }

    function getUser($id) {
        $user = \App\User::where("id", "=", $id)->first();

        if($user == "") return "not found";

        return "<a href='".url('/getAllUser')."'>[All Users]</a><br/>".$user->name;
    }

    function editUser($id) {
        if(\Auth::user()->role != "admin") return \Redirect::to('/maaf');

        $user = \App\User::where("id", "=", $id)->first();

        if($user == "") return "not found";

        return \View::make('index/edit')->with(compact('user'));
    }

    function editUserPost($id) {
        if(\Auth::user()->role != "admin") return \Redirect::to('/maaf');

        $nama = \Request::input('nama');
        $name = \Request::input('name');
        $email = \Request::input('email');

        $user = \App\User::where("id", "=", $id)->first();
        $user->nama = $nama;
        $user->name = $name;
        $user->email = $email;

        if (\Request::hasFile('logo')) {
            if (\Request::file('logo')->isValid()) {
                $extension = \Request::file('logo')->getClientOriginalExtension();
                $foto = $name.".".$extension;

                \Request::file('logo')->move('./foto', $foto);
                //\Request::file('logo')->move(base_path().'/logo', $logo);

                $user->foto = $foto;
            }
        }

        if($user->save()){
            return \Redirect::to('/getUser/'.$id);
        }
    }

    function removeUser($id) {
        if(\Auth::user()->role != "admin") return \Redirect::to('/maaf');

        $user = \App\User::where("id", "=", $id)->first();

        if($user == "") return "not found";

        if($user->delete()) {
            return \Redirect::to('/getAllUser');
        }
    }

    function addUser2() {
        return "forbidden";
    }

    function addUser() {
        if(\Auth::user()->role != "admin") return \Redirect::to('/maaf');
        
        $nama = \Request::input('nama');
        $name = \Request::input('name');
        $password = \Request::input('password');
        $email = \Request::input('email');

        if($nama == "") return "nama tidak boleh kosong";

        $user = new \App\User();
        $user->nama = $nama;
        $user->name = $name;
        $user->password = \Hash::make($password);
        $user->email = $email;

        if (\Request::hasFile('logo')) {
            if (\Request::file('logo')->isValid()) {
                $extension = \Request::file('logo')->getClientOriginalExtension();
                $foto = $name.".".$extension;

                \Request::file('logo')->move('./foto', $foto);
                //\Request::file('logo')->move(base_path().'/logo', $logo);

                $user->foto = $foto;
            }
        }

        if($user->save()) return "berhasil";
    }
}
