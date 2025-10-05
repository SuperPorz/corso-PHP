<?php

namespace Database\Factories;

use App\Models\Libri;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestiti>
 */
class PrestitiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //prestiti chiusi in tempo
        return [
            'idl' => Libri::inRandomOrder()->value('idl'),
            'idu' => User::inRandomOrder()->value('idu'),
            'inizio_prestito' => fake()->dateTimeBetween('-6 month', '-4 week'),
            'fine_prestito' => fake()->dateTimeBetween('-1 week', '+6 week')
        ];
    }

    public function aperti(): static
    {
       return $this->state(fn (array $attributes) => [
            'fine_prestito' => null,
        ]); 
    }

    public function scaduti(): static
    {
       return $this->state(fn (array $attributes) => [
            'inizio_prestito' => fake()->dateTimeBetween('-6 month', '-2 month'),
            'fine_prestito' => fake()->dateTimeBetween('-3 week', '-1 week'),
        ]); 
    }
}
