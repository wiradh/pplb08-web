<?php

use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'wiradh',
            'role' => 'CU',
            'email' => 'wira@wira.com',
            'password' => \Hash::make('asdfqwer'),
            'remember_token' => '',
            'created_at' => '2016-02-25 16:24:16',
            'updated_at' => '2016-02-25 16:24:16',       
        ]);
        DB::table('users')->insert([
            'name' => 'laundry',
            'role' => 'LA',
            'email' => 'laundry@wira.com',
            'password' => \Hash::make('asdfqwer'),
            'remember_token' => '',
            'id_penyedia' => '1',
            'created_at' => '2016-02-25 16:24:16',
            'updated_at' => '2016-02-25 16:24:16',       
        ]);
        DB::table('penyedia')->insert([
            'nama' => 'goclean',
            'detail' => 'pasti bersih',
            'alamat' => 'depok',
            'harga' => '5000',
            'rate' => '0',
            'jangkauan' => '3',
            'longitude' => '123',
            'lattitude' => '4',
            'telepon' => '342423423',
            'created_at' => '2016-02-25 16:24:16',
            'updated_at' => '2016-02-25 16:24:16',       
        ]);

        DB::table('order')->insert([
            'status' => '0',
            'jam_antar' => '12.00',
            'jam_ambil' => '15.00',
            'longitude' => '123',
            'lattitude' => '33',
            'berat' => '',
            'tipe' => '',
            'id_penyedia' => '1',
            'id_pelanggan' => '1',
            'created_at' => '2016-02-25 16:24:16',
            'updated_at' => '2016-02-25 16:24:16',       
        ]);

        DB::table('order')->insert([
            'status' => '2',
            'jam_antar' => '15.00',
            'jam_ambil' => '11.00',
            'longitude' => '123',
            'lattitude' => '33',
            'berat' => '',
            'tipe' => '',
            'id_penyedia' => '1',
            'id_pelanggan' => '1',
            'created_at' => '2016-02-25 16:24:16',
            'updated_at' => '2016-02-25 16:24:16',       
        ]);

        DB::table('order')->insert([
            'status' => '3',
            'jam_antar' => '11.00',
            'jam_ambil' => '17.00',
            'longitude' => '123',
            'lattitude' => '33',
            'berat' => '4',
            'tipe' => '',
            'id_penyedia' => '1',
            'id_pelanggan' => '1',
            'created_at' => '2016-02-25 16:24:16',
            'updated_at' => '2016-02-25 16:24:16',       
        ]);

        DB::table('order')->insert([
            'status' => '4',
            'jam_antar' => '12.00',
            'jam_ambil' => '15.00',
            'longitude' => '123',
            'lattitude' => '33',
            'berat' => '9',
            'tipe' => '',
            'id_penyedia' => '1',
            'id_pelanggan' => '1',
            'created_at' => '2016-02-25 16:24:16',
            'updated_at' => '2016-02-25 16:24:16',       
        ]);

        DB::table('order')->insert([
            'status' => '5',
            'jam_antar' => '12.00',
            'jam_ambil' => '15.00',
            'longitude' => '123',
            'lattitude' => '33',
            'berat' => '10',
            'tipe' => '',
            'id_penyedia' => '1',
            'id_pelanggan' => '1',
            'created_at' => '2016-02-25 16:24:16',
            'updated_at' => '2016-02-25 16:24:16',       
        ]);
    }
}
