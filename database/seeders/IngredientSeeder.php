<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;


class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            ['name' => 'Poulet', 'default_unit' => 'g'],
            ['name' => 'Riz', 'default_unit' => 'g'],
            ['name' => 'Avocat', 'default_unit' => 'unité'],
            ['name' => 'Pain', 'default_unit' => 'tranche'],
            ['name' => 'Oeuf', 'default_unit' => 'unité'],
            ['name' => 'Lait', 'default_unit' => 'ml'],
        ];

        foreach ($ingredients as $ing) {
            Ingredient::create($ing);
        }
    }
}
