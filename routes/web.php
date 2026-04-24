<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('recipes', RecipeController::class);
    Route::get('/my-week', [MealPlanController::class, 'index'])->name('meal_plans.index');
    Route::post('/meal-plans', [MealPlanController::class, 'store'])->name('meal_plans.store');
    Route::patch('/meal-plans/{mealPlan}/toggle', [MealPlanController::class, 'toggleDone']);
    Route::delete('/meal-plans/{mealPlan}', [MealPlanController::class, 'destroy'])->name('meal_plans.destroy');

    // Shopping List (Nouvelle Route)
    Route::get('/shopping-list', [ShoppingListController::class, 'index'])->name('shopping_list.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});