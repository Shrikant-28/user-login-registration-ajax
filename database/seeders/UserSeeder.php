<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'          => 'Admin',
            'phone_number'  => '9876543210',
            'gender'        => null,
            'city'          => null,
            'signup_for_letters'=> 0,
            'agree_to_tc'   => 1,
            'password'      => Hash::make('password'),
            'role'          => 'Admin'
        ]);
    }
}
