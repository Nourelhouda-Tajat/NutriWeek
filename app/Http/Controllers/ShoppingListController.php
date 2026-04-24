<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function index()
    {
        // 1. On définit la période (cette semaine)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // 2. On récupère tes repas prévus avec leurs recettes et leurs ingrédients
        $plans = MealPlan::with('recipe.ingredients')
            ->where('user_id', auth()->id())
            ->whereBetween('planned_date', [$startOfWeek, $endOfWeek])
            ->get();

        // 3. Étape de calcul "faite main" (plus facile à comprendre)
        $shoppingList = [];

        foreach ($plans as $plan) {
            foreach ($plan->recipe->ingredients as $ingredient) {
                // Formule : (Quantité de base / Portions de base) * Portions prévues
                $neededQuantity = ($ingredient->pivot->quantity / $plan->recipe->servings) * $plan->serving;
                
                $key = $ingredient->name . $ingredient->pivot->unit; // Clé unique par ingrédient et unité

                if (isset($shoppingList[$key])) {
                    // Si l'ingrédient est déjà dans la liste, on ajoute la quantité
                    $shoppingList[$key]['quantity'] += $neededQuantity;
                } else {
                    // Sinon, on le crée dans le tableau
                    $shoppingList[$key] = [
                        'name' => $ingredient->name,
                        'quantity' => $neededQuantity,
                        'unit' => $ingredient->pivot->unit
                    ];
                }
            }
        }

        return view('shopping_list.index', [
            'ingredients' => $shoppingList,
            'startOfWeek' => $startOfWeek
        ]);
    }
}