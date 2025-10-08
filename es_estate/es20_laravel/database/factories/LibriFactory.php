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
        // Genera collocazione realistica: SCAFFALE.RIPIANO.POSIZIONE
        $scaffale = fake()->randomElement(['A', 'B', 'C', 'D', 'E']);
        $ripiano = fake()->numberBetween(1, 5);
        $posizione = str_pad(fake()->numberBetween(1, 6), 2, '0', STR_PAD_LEFT);
        
        // Genera titoli realistici
        $titoloFormats = [
            fn() => 'Il ' . fake()->word() . ' di ' . fake()->city(),
            fn() => 'La ' . fake()->word() . ' perduta',
            fn() => fake()->words(2, true),
            fn() => 'Storia di ' . fake()->firstName(),
            fn() => 'Le ' . fake()->word() . ' del ' . fake()->monthName(),
            fn() => fake()->word() . ' senza fine',
            fn() => 'Il segreto di ' . fake()->city(),
            fn() => 'L\'arte di ' . fake()->word(),
            fn() => fake()->lastName() . ': una biografia',
            fn() => 'Viaggio a ' . fake()->country(),
            fn() => 'Manuale di ' . fake()->word(),
            fn() => 'Introduzione alla ' . fake()->word(),
        ];
        
        $titolo = fake()->randomElement($titoloFormats)();
        $titolo = ucfirst($titolo);
        
        // Genere e Dewey correlati (Sistema Decimale Dewey reale)
        $generiDewey = [
            'Narrativa' => [
                'range' => [800, 899],
                'sottoclassi' => [813, 823, 833, 843, 853, 863, 873, 883] // Letterature nazionali
            ],
            'Saggistica' => [
                'range' => [0, 99],
                'sottoclassi' => [1, 20, 30, 50, 70, 80, 90]
            ],
            'Poesia' => [
                'range' => [808, 821],
                'sottoclassi' => [808.81, 811, 821, 831, 841, 851, 861, 871, 881]
            ],
            'Teatro' => [
                'range' => [792, 812],
                'sottoclassi' => [792, 808.82, 812, 822, 832, 842, 852, 862, 872]
            ],
            'Filosofia' => [
                'range' => [100, 199],
                'sottoclassi' => [100, 110, 120, 130, 140, 150, 160, 170, 180, 190]
            ],
            'Storia' => [
                'range' => [900, 999],
                'sottoclassi' => [900, 910, 920, 930, 940, 950, 960, 970, 980, 990]
            ],
            'Biografia' => [
                'range' => [920, 929],
                'sottoclassi' => [920, 921, 922, 923, 924, 925, 926, 927, 928, 929]
            ],
            'Scienze' => [
                'range' => [500, 599],
                'sottoclassi' => [500, 510, 520, 530, 540, 550, 560, 570, 580, 590]
            ],
            'Arte' => [
                'range' => [700, 799],
                'sottoclassi' => [700, 710, 720, 730, 740, 750, 760, 770, 780, 790]
            ],
            'Ragazzi' => [
                'range' => [800, 899],
                'sottoclassi' => [808.068, 813, 823, 833, 843, 853]
            ],
        ];
        
        $genere = fake()->randomElement(array_keys($generiDewey));
        $deweyData = $generiDewey[$genere];
        
        // Scegli una sottoclasse specifica del genere
        $deweyBase = fake()->randomElement($deweyData['sottoclassi']);
        // Aggiungi decimali per specificità
        $dewey = $deweyBase . '.' . fake()->numberBetween(0, 99);
        
        return [
            'titolo' => $titolo,
            'autore' => fake()->name(),
            'genere' => $genere,
            'dewey' => $dewey,
            'collocazione' => "{$scaffale}.{$ripiano}.{$posizione}"
        ];
    }
}