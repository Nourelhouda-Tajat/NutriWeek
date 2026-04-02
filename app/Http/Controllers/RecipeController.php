<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Auth::user()->recipes()->with('category')->latest()->get();
        return view('recipes.index', compact('recipes'));
    }

    public function show(Recipe $recipe)
    {
        $recipe->load(['ingredients', 'category']);
        return view('recipes.show', compact('recipe'));
    }

    public function create(Category $category,Ingredient $ingredient)
    {
        return view('recipes.create', [
            'categories' => $category->all(),
            'ingredients' => $ingredient->all()
        ]);
    }

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


