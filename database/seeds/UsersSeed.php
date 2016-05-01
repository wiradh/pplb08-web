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

    }
}
