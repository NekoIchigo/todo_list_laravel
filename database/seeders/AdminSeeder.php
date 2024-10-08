<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'username' => 'admin',
            'user_type' => 'admin',
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('user_details')->insert([
            'user_id' => $userId,
            'first_name' => 'Admin',
            'email' => 'admin@email.com',
            'last_name' => 'Admin',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
