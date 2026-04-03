<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Category;


class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nour = User::where('username', 'Nour')->first();
        $antoine = User::where('username', 'bob')->first();
        $catVedge = Category::where('name', 'Végétarien')->first();

        $r1 = Recipe::create([
            'user_id' => $nour->id,
            'category_id' => $catVedge->id,
            'title' => 'Ma Salade Secrète',
            'instructions' => 'Mélanger tout.',
            'prep_time' => 5,
            'servings' => 1,
            'is_public' => false
        ]);

        $r2 = Recipe::create([
            'user_id' => $nour->id,
            'category_id' => $catVedge->id,
            'title' => 'Mon Avocado Toast Public',
            'instructions' => 'Ecraser l\'avocat sur le pain.',
            'prep_time' => 10,
            'servings' => 2,
            'is_public' => true
        ]);

        $r3 = Recipe::create([
            'user_id' => $antoine->id,
            'category_id' => $catVedge->id,
            'title' => 'Le Curry de Chef Bob',
            'instructions' => 'Faire mijoter les épices.',
            'prep_time' => 30,
            'servings' => 4,
            'is_public' => true
        ]);

        $avocat = Ingredient::where('name', 'Avocat')->first();
        $pain = Ingredient::where('name', 'Pain')->first();
        $r2->ingredients()->attach([
            $avocat->id => ['quantity' => 1, 'unit' => 'unité'],
            $pain->id => ['quantity' => 2, 'unit' => 'tranches']
        ]);
    }
}
