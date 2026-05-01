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
        $recipes = Recipe::with('category', 'user')
            ->where('is_public', true)
            ->orWhere('user_id', auth()->id())
            ->latest()
            ->get();

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
            // On récupère uniquement les catégories uniques d'ingrédients pour le premier menu
            'ingredientCategories' => $ingredient->select('category')->whereNotNull('category')->distinct()->pluck('category')
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
    public function edit(Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        $ingredients = Ingredient::all();
        
        return view('recipes.edit', compact('recipe', 'categories', 'ingredients'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'instructions' => 'required',
            'prep_time' => 'required|integer',
            'servings' => 'required|integer',
            'ingredients' => 'required|array',
        ]);

        $recipe->update($request->all());

        $ingredients = collect($request->ingredients)->mapWithKeys(function ($item) {
            return [$item['id'] => ['quantity' => $item['quantity'], 'unit' => $item['unit']]];
        });

        $recipe->ingredients()->sync($ingredients);

        return redirect()->route('recipes.index')->with('success', 'Recette modifiée !');
    }
    
    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->id()) abort(403);

        $recipe->delete(); 
        return redirect()->route('recipes.index')->with('success', 'Recette supprimée.');
    }
}


