<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
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
        $bob = User::where('username', 'bob')->first();
        $catVedge = Category::where('name', 'Lunch')->first();
        $avocat = Ingredient::where('name', 'Avocat')->first();
        $pain = Ingredient::where('name', 'Pain')->first();
        $poulet = Ingredient::where('name', 'Poulet')->first();
        $riz = Ingredient::where('name', 'Riz')->first();
        $oeuf = Ingredient::where('name', 'Oeuf')->first();

        $r1 = Recipe::create([
            'user_id' => $nour->id,
            'category_id' => $catVedge->id,
            'title' => 'Ma Salade Secrète',
            'instructions' => 'Mélanger tout dans un bol.',
            'prep_time' => 5,
            'servings' => 1,
            'is_public' => false
        ]);
        $r1->ingredients()->attach([
            $oeuf->id => ['quantity' => 2, 'unit' => 'unités'],
            $avocat->id => ['quantity' => 1, 'unit' => 'unité']
        ]);

        $r2 = Recipe::create([
            'user_id' => $nour->id,
            'category_id' => $catVedge->id,
            'title' => 'Mon Avocado Toast Public',
            'instructions' => 'Ecraser l\'avocat sur le pain toasté.',
            'prep_time' => 10,
            'servings' => 2,
            'is_public' => true
        ]);
        $r2->ingredients()->attach([
            $avocat->id => ['quantity' => 1, 'unit' => 'unité'],
            $pain->id => ['quantity' => 2, 'unit' => 'tranches']
        ]);

        $r3 = Recipe::create([
            'user_id' => $bob->id,
            'category_id' => $catVedge->id,
            'title' => 'Le Curry de Chef Bob',
            'instructions' => 'Faire mijoter le poulet avec les épices et servir avec le riz.',
            'prep_time' => 30,
            'servings' => 4,
            'is_public' => true
        ]);
        $r3->ingredients()->attach([
            $poulet->id => ['quantity' => 500, 'unit' => 'g'],
            $riz->id => ['quantity' => 300, 'unit' => 'g']
        ]);
    }
}
