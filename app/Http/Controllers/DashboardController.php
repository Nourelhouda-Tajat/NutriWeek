<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\MealPlan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $recipeCount = $user->recipes()->count();

        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        
        $plans = $user->mealPlans()
            ->whereBetween('planned_date', [$startOfWeek, $endOfWeek])
            ->with('recipe.ingredients')
            ->get();

        $shoppingCount = $plans->flatMap(function($plan) {
            return $plan->recipe->ingredients;
        })->unique('name')->count();

        $weeklyPlans = $plans->groupBy(function($data) {
            return $data->planned_date->format('D'); 
        });

        return view('dashboard', compact('user', 'recipeCount', 'shoppingCount', 'weeklyPlans'));
    }
}