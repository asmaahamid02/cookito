<?php

use App\Http\Controllers\{
    CategoryController,
    HomeController,
    ProfileController,
    RecipeController
};
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search');
Route::resource('recipes', RecipeController::class)->names([
    'index' => 'recipes',
    'show' => 'recipes.show',
    'create' => 'recipes.create',
    'store' => 'recipes.store',
    'edit' => 'recipes.edit',
    'update' => 'recipes.update',
    'destroy' => 'recipes.destroy',
]);

//search

Route::resource('categories', CategoryController::class)->names([
    'index' => 'categories',
    'show' => 'categories.show',
    'create' => 'categories.create',
    'store' => 'categories.store',
    'edit' => 'categories.edit',
    'update' => 'categories.update',
    'destroy' => 'categories.destroy',
]);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
