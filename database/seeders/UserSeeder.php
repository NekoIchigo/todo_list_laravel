<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'user_type' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        DB::table('users')->insert([
            'username' => 'user',
            'email' => 'user@email.com',
            'user_type' => 'user',
            'password' => Hash::make('user'),
        ]);
    }
}
