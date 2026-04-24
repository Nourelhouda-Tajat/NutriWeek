<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Calcul des statistiques simples
        $stats = [
            'total_users' => User::count(),
            'total_recipes' => Recipe::count(),
            'total_ingredients' => Ingredient::count(),
            'public_recipes' => Recipe::where('is_public', true)->count(),
        ];

        // 2. Récupération de tous les utilisateurs pour le tableau
        $users = User::all();

        return view('admin.index', compact('stats', 'users'));
    }

    public function destroyUser(User $user)
    {
        // Empêcher l'admin de se supprimer lui-même par erreur
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte admin.');
        }

        $user->delete();
        return back()->with('success', 'L\'utilisateur a été retiré du jardin.');
    }
}