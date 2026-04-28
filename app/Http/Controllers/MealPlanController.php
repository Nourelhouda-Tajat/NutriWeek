<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MealPlanController extends Controller
{
    /**
     * Affiche le planning de la semaine
     */
    public function index()
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        // Récupère les plans et les groupe par date pour un accès facile en Blade
        $weeklyPlans = auth()->user()->mealPlans()->with('recipe')
            ->where('user_id', auth()->id())
            ->whereBetween('planned_date', [$startOfWeek, $endOfWeek])
            ->get()
            ->groupBy('planned_date');

        // $availableRecipes = Recipe::where('user_id', $user->id)
        //     ->orWhere('is_public', true)
        //     ->select('id', 'title') 
        //     ->get();
        $availableRecipes = auth()->user()->recipes()->select('id', 'title')->get();

        return view('meal_plans.index', compact('weeklyPlans', 'startOfWeek', 'availableRecipes'));
    }

    /**
     * Ajoute une recette au planning (Action du bouton "Add to weekly plan")
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'planned_date' => 'required|date|after_or_equal:today',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
            'serving' => 'required|integer|min:1'
        ]);

        MealPlan::create([
            'user_id' => auth()->id(),
            'recipe_id' => $request->recipe_id,
            'planned_date' => $request->planned_date,
            'meal_type' => $request->meal_type,
            'serving' => $request->serving,
            'isDone' => false
        ]);

        return redirect()->route('dashboard')->with('success', 'Plat ajouté au jardin de la semaine !');
    }

    /**
     * Toggle l'état "isDone" (quand tu coches le repas)
     */
    public function toggleDone(MealPlan $mealPlan)
    {
        if ($mealPlan->user_id !== auth()->id()) abort(403);

        $mealPlan->update(['isDone' => !$mealPlan->isDone]);

        return response()->json(['success' => true]);
    }

    public function destroy(MealPlan $mealPlan)
    {
        if ($mealPlan->user_id !== auth()->id()) {
            abort(403);
        }

        $mealPlan->delete();
        return back()->with('success', 'Repas supprimé.');
    }
}