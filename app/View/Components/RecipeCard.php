<?php

namespace App\View\Components;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecipeCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Recipe $recipe)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recipe-card');
    }
}
