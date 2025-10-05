<?php

namespace Database\Seeders;

use App\Models\Prestiti;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestitiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prestiti::factory()->count(10)->create(); //prestiti chiusi
        Prestiti::factory()->count(5)->aperti()->create(); //prestiti aperti
        Prestiti::factory()->count(5)->scaduti()->create(); //prestiti scaduti
    }
}
