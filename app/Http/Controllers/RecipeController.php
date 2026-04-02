<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // Dans RecipeController.php
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'instructions' => 'required|string',
            'prep_time' => 'required|integer',
            'servings' => 'required|integer',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|gt:0',
            'ingredients.*.unit' => 'required|string',
        ]);

        return DB::transaction(function () use ($validated, $request) {
            $recipe = auth()->user()->recipes()->create([
                'title' => $validated['title'],
                'category_id' => $validated['category_id'],
                'description' => $request->description,
                'instructions' => $validated['instructions'],
                'servings' => $validated['servings'],
                'prep_time' => $validated['prep_time'],
            ]);

            foreach ($validated['ingredients'] as $ing) {
                $recipe->ingredients()->attach($ing['id'], [
                    'quantity' => $ing['quantity'],
                    'unit' => $ing['unit']
                ]);
            }

            return redirect()->route('recipes.index')->with('success', 'Recette ajoutée !');
        });
    }
}


