<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Création d'un utilisateur de test (Nour)
        $user = User::updateOrCreate(
            ['email' => 'nour@example.com'],
            [
                'username' => 'NourDev',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        // 2. Création de catégories
        $categories = ['Petit-déjeuner', 'Plat Principal', 'Dessert', 'Végétarien', 'Snack'];
        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat]);
        }

        // 3. Création d'ingrédients de base
        $ingredientsData = [
            ['name' => 'Tomate', 'default_unit' => 'g'],
            ['name' => 'Pâtes', 'default_unit' => 'g'],
            ['name' => 'Huile d\'olive', 'default_unit' => 'ml'],
            ['name' => 'Oeuf', 'default_unit' => 'unité'],
            ['name' => 'Poulet', 'default_unit' => 'g'],
        ];

        foreach ($ingredientsData as $ing) {
            Ingredient::updateOrCreate(['name' => $ing['name']], $ing);
        }

        // 4. Création d'une recette de test liée à l'utilisateur
        $recipe = Recipe::create([
            'user_id' => $user->id,
            'category_id' => Category::where('name', 'Plat Principal')->first()->id,
            'title' => 'Pâtes à la Tomate',
            'description' => 'Un classique rapide et délicieux.',
            'instructions' => '1. Cuire les pâtes. 2. Ajouter la sauce tomate. 3. Servir chaud.',
            'servings' => 2,
            'prep_time' => 15,
            'is_public' => true,
        ]);

        // 5. Attachement des ingrédients à la recette via la table pivot
        $pates = Ingredient::where('name', 'Pâtes')->first();
        $tomate = Ingredient::where('name', 'Tomate')->first();

        $recipe->ingredients()->attach([
            $pates->id => ['quantity' => 250, 'unit' => 'g'],
            $tomate->id => ['quantity' => 400, 'unit' => 'g'],
        ]);
    }
}