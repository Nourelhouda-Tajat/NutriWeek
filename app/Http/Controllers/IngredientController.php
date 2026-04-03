<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
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
            'default_unit' => 'nullable|string|max:20',
        ]);

        Ingredient::create($validated);

        return redirect()->route('ingredients.index')->with('success', 'Ingrédient ajouté au référentiel.');
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

    
}
