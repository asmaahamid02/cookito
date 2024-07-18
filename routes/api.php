<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/signin', [AuthenticatedSessionController::class, 'apiLogin']);

Route::post('/recipes', [RecipeController::class, 'store'])->middleware('auth:sanctum');
