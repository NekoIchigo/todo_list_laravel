<?php

namespace Database\Seeders;

use App\Models\ToDo;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopulateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(20)
            ->has(UserDetails::factory())
            ->has(ToDo::factory()->count(3))
            ->create();
    }
}
