<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            ['name' => 'Poulet', 'default_unit' => 'g', 'category' => 'Protines'],
            ['name' => 'papriqua', 'default_unit' => 'g', 'category' => 'Epises'],
            ['name' => 'Riz', 'default_unit' => 'g', 'category' => 'Féculents'],
            ['name' => 'Avocat', 'default_unit' => 'unité', 'category' => 'Fruits'],
            ['name' => 'Pain', 'default_unit' => 'tranche', 'category' => 'Féculents'],
            ['name' => 'Oeuf', 'default_unit' => 'unité', 'category' => 'Produits Laitiers'],
            ['name' => 'Lait', 'default_unit' => 'ml', 'category' => 'Produits Laitiers'],
            ['name' => 'Tomate', 'default_unit' => 'g', 'category' => 'Légumes'],
        ];

        foreach ($ingredients as $ing) {
            Ingredient::updateOrCreate(['name' => $ing['name']], $ing);
        }
    }
}