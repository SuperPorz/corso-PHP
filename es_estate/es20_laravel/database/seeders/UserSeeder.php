<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Utente NORMALE fisso per debug
        User::firstOrCreate(
            ['email' => 'pincopallo@gmail.com'], // Condizione di ricerca
            [
                'name' => 'pincopallo',
                'password' => Hash::make('cacca1234'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );

        // Utente ADMIN fisso per debug
        User::firstOrCreate(
            ['email' => 'bubula@gmail.com'], // Condizione di ricerca
            [
                'name' => 'bubula',
                'email' => 'bubula@gmail.com',
                'password' => Hash::make('cacca1234'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // 6 users verificati
        User::factory()->count(6)->create();

        // 3 users non verificati
        User::factory()->count(3)->unverified()->create();

        // 1 admin
        User::factory()->count(1)->give_admin()->create();
    }
}