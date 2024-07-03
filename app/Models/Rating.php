<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'user_id',
        'recipe_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByRecipe($query, $recipeId)
    {
        return $query->where('recipe_id', $recipeId);
    }

    public function scopeRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    public function scopeAvgRating($query, $recipeId)
    {
        return $query->where('recipe_id', $recipeId)->avg('rating');
    }

    public function scopeCountRating($query, $recipeId)
    {
        return $query->where('recipe_id', $recipeId)->count();
    }
}
