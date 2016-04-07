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
    }
}
