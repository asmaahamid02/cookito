<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Recipe extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'description',
        'prep_time',
        'cook_time',
        'servings',
        'calories',
        'protein',
        'carbs',
        'image',
        'user_id',
    ];

    protected $withCount = [
        'ratings',
    ];

    ########### Searchable ###########
    public function searchableAs(): string
    {
        return 'recipes';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user' => $this->user->name,
            'categories' => $this->categories ? $this->categories->map(function ($category) {
                return $category->name;
            })->toArray() : [],
            'ingredients' => $this->ingredients ? $this->ingredients->map(function ($ingredient) {
                return $ingredient->name ?? '';
            })->toArray() : [],
            'instructions' => $this->instructions ? $this->instructions->map(function ($instruction) {
                return $instruction->description ?? '';
            })->toArray() : [],
        ];
    }

    ########### Relationships ###########
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function avgRatings()
    {
        return $this->hasMany(Rating::class)
            ->selectRaw('recipe_id, avg(rating) as total')
            ->groupBy('recipe_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_recipes')->withTimestamps();
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function instructions()
    {
        return $this->hasMany(Instruction::class);
    }

    public function userRate(User $user)
    {
        return $this->ratings()->where('user_id', $user->id)->first();
    }

    ########### Accessors ###########
    public function getPrepTimeAttribute($value)
    {
        return DateHelper::formatTime($value);
    }

    public function getCookTimeAttribute($value)
    {
        return DateHelper::formatTime($value);
    }


    ########### Scopes ###########
    public function scopeWhereCategory($query, $category)
    {
        return $query->whereHas('categories', function ($query) use ($category) {
            $query->where('name', 'iLIKE', "%$category%");
        });
    }
}
