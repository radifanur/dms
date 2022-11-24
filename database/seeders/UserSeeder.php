<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

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
            'name' => 'Jihan Faradina',
            'email' => 'jihanfaradina'.'@gmail.com',
            'level' => 1,
            'password' => Hash::make('jihan123'),
        ]);
    }
}
