<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function getByCategory(Request $request)
    {
        $category = $request->query('category');
        
        $ingredients = Ingredient::where('category', $category)
            ->orderBy('name')
            ->select('id', 'name', 'default_unit')
            ->get();
            
        return response()->json($ingredients);
    }

    public function index()
    {
        $ingredients = Ingredient::orderBy('name')->get();
        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('ingredients.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:ingredients,name|max:255',
            'category' => 'required|string|max:100', 
            'default_unit' => 'nullable|string|max:20',
        ]);

        $ingredient = Ingredient::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'id' => $ingredient->id,
                'name' => $ingredient->name,
                'category' => $ingredient->category 
            ]);
        }

        return redirect()->route('ingredients.index')->with('success', 'Ingrédient ajouté.');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:ingredients,name,' . $ingredient->id,
            'default_unit' => 'nullable|string|max:20',
        ]);

        $ingredient->update($validated);

        return redirect()->route('ingredients.index')->with('success', 'Ingrédient mis à jour.');
    }

    public function destroy(Ingredient $ingredient)
    {
        // Règle de gestion : Ne pas supprimer si utilisé dans une recette
        if ($ingredient->recipes()->exists()) {
            return back()->with('error', 'Impossible de supprimer : cet ingrédient est utilisé dans des recettes.');
        }

        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success', 'Ingrédient supprimé.');
    }
}
a