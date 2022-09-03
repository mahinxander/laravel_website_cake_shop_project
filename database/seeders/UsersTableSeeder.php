<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'=>'admin@gmail.com',
            'name'=>'admin',
            'phone_number'=>'12345678910',
            'role_as'=>'1',
            'password'=>bcrypt('123456')
        ]);
        User::create([
            'email'=>'arpita@gmail.com',
            'name'=>'arpita',
            'phone_number'=>'12345678910',
            'role_as'=>'0',
            'password'=>bcrypt('123456')
        ]);


    }
}
