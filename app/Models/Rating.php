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

    ########### Relationships ###########
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    ########### Scopes ###########
    public function scopeWhereUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeWhereRecipe($query, $recipeId)
    {
        return $query->where('recipe_id', $recipeId);
    }

    public function scopeWhereRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }
}
