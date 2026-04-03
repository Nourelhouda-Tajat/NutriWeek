<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;
use App\Models\MealPlan;


class MealPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        $nour = User::where('username', 'Nour')->first();
        $recipe = Recipe::first();

        MealPlan::create([
            'user_id' => $nour->id,
            'recipe_id' => $recipe->id,
            'serving' => 2,
            'meal_type' => 'lunch',
            'planned_date' => now()->format('Y-m-d'), 
            'isDone' => false
        ]);

        MealPlan::create([
            'user_id' => $nour->id,
            'recipe_id' => $recipe->id,
            'serving' => 2,
            'meal_type' => 'dinner',
            'planned_date' => now()->addDay()->format('Y-m-d'), 
            'isDone' => false
        ]);
    }
    
}
