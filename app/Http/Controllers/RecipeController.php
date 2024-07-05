<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    protected $page_limit = 12;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $recipes = Recipe::with('categories')->with('user');

        if ($request->has('category')) {
            $recipes->whereCategory($request->category);
        }

        $recipes = $recipes->orderBy('created_at', 'desc')->paginate($this->page_limit)->withQueryString();

        return view('recipes.index', [
            'recipes' => $recipes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
    }

    /**
     * Search for recipes.
     */
    public function search(Request $request)
    {
        if ($request->has('search_term')) {
            $recipes = Recipe::search($request->search_term)->orderBy('created_at', 'desc')->paginate($this->page_limit)->withQueryString();
            $recipes->load('categories', 'user');

            return view('recipes.index', [
                'recipes' => $recipes,
            ]);
        } else {
            return back();
        }
    }
}
