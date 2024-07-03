<?php

use App\Http\Controllers\{
    HomeController,
    ProfileController,
    RecipeController
};
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::resource('recipes', RecipeController::class)->names([
    'index' => 'recipes',
    'show' => 'recipes.show',
    'create' => 'recipes.create',
    'store' => 'recipes.store',
    'edit' => 'recipes.edit',
    'update' => 'recipes.update',
    'destroy' => 'recipes.destroy',
]);

Route::get('/categories', function () {
    return view('categories.index');
})->name('categories');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
