<?php

namespace Database\Seeders;

use App\Models\Libri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Libri::factory()->count(10)->create();
    }
}
