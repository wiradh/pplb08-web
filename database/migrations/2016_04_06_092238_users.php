<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('id_penyedia');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('jam_antar');
            $table->string('jam_ambil');
            $table->string('longitude');
            $table->string('lattitude');
            $table->string('tipe');
            $table->string('id_penyedia');
            $table->string('id_pelanggan');
            $table->timestamps();
        });

        Schema::create('penyedia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('detail');
            $table->string('harga');
            $table->string('alamat');
            $table->string('rate');
            $table->string('jangkauan');
            $table->string('longitude');
            $table->string('lattitude');
            $table->string('telepon');
            $table->string('last_login');
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
