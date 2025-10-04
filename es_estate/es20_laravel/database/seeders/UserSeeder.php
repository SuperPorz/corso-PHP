<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 6 users verificati
        User::factory()->count(6)->create();

        // 3 users non verificati
        User::factory()->count(3)->unverified()->create();

        // 1 admin
        User::factory()->count(1)->give_admin()->create();
    }
}
