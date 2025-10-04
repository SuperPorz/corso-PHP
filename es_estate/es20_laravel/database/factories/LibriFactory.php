<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libri>
 */
class LibriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titolo' => fake()->city(),
            'autore' => fake()->name(),
            'genere' => fake()->jobTitle(),
            'dewey' => fake()->bothify('###.#??'),
            'collocazione' => 'PT'
        ];
    }
}


/* fake()->randomElements([
                'PTa',
                'PTb',
                'PTc',
                'P1a',
                'P1b',
                'P1c',
                'P2a',
                'P2b',
                'P2c',
            ]) */