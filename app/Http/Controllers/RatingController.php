<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Recipe;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function storeOrUpdate(StoreRatingRequest $request, Recipe $recipe)
    {
        $request->validated();

        //check if the user has user role
        if (!auth()->user()->hasRole('user')) {
            return back()->with('error', 'You do not have permission to rate a recipe');
        }

        //check if the recipe is for the user
        if ($recipe->user->is(auth()->user())) {
            return back()->with('error', 'You cannot rate your own recipe');
        }

        $userRate = $recipe->ratings()->updateOrCreate([
            'user_id' => auth()->id(),
        ], [
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        $is_update = $userRate->wasChanged();

        return back()->with('success', 'Rating ' . ($is_update ? 'updated' : 'added') . ' successfully')
            ->with('userRate', $userRate);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
