<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $categories = Category::orderBy('name')->get();
        return view('recipes.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        $request->validated();

        //check if the user has author role
        if (!auth()->user()->hasRole('user')) {
            Log::channel('recipe')->error('User does not have author role');

            if ($request->is('api/*')) {
                return response()->json(['message' => 'You do not have permission to create a recipe'], 403);
            }

            return back()->with('error', 'You do not have permission to create a recipe');
        }

        Log::channel('recipe')->info('#### Creating recipe ####');

        try {
            DB::transaction(function () use ($request) {
                $recipe = new Recipe();
                $recipe->fill($request->except('image', 'ingredients', 'instructions', 'categories'));
                $recipe->user_id = auth()->id();

                $recipe->save();

                Log::channel('recipe')->info('Recipe record created');

                //add image to the storage
                if ($request->has('image')) {
                    $folder = 'images/recipes/' . $recipe->id;
                    $saved_file = $request->file('image')->store($folder, 'public');
                    $recipe->image = substr($saved_file, 15);
                    $recipe->save();

                    Log::channel('recipe')->info('Recipe image added', ['recipe_image' => $recipe->image]);
                }


                $recipe->categories()->attach($request->categories);

                $recipe->ingredients()->createMany($request->ingredients);
                $recipe->instructions()->createMany($request->instructions);
            });

            Log::channel('recipe')->info('#### Recipe created successfully ####');
        } catch (\Exception $e) {
            Log::channel('recipe')->error('Error creating recipe', ['error' => $e->getMessage()]);

            if ($request->is('api/*')) {
                return response()->json(['message' => 'Error creating recipe. ERROR: ' . $e->getMessage()], 500);
            }

            return back()->with('error', 'Error creating recipe. ERROR: ' . $e->getMessage());
        }

        //return response based on the request
        if ($request->is('api/*')) {
            return response()->json(['message' => 'Recipe created successfully'], 201);
        }

        return back()->with('success', 'Recipe created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe->load('categories', 'user', 'ingredients', 'instructions');

        return view('recipes.show', [
            'recipe' => $recipe,
        ]);
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
