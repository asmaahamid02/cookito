<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::inRandomOrder()->take(6)->get();

        $latestRecipes = Recipe::latest()->with('categories')->with('user')->take(8)->get();

        // return response()->json([
        //     'categories' => $categories,
        //     'recipes' => $latestRecipes,
        // ]);
        return view('dashboard', [
            'categories' => $categories,
            'recipes' => $latestRecipes,
        ]);
    }
}
