<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'prep_time',
        'cook_time',
        'servings',
        'calories',
        'protein',
        'tags',
        'image',
        'user_id',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    protected $appends = [
        'average_rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_recipes')->withTimestamps();
    }

    public function ingredients()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function instructions()
    {
        return $this->belongsTo(Instruction::class);
    }

    public function getPrepTimeAttribute($value)
    {
        return DateHelper::formatTime($value);
    }

    public function getCookTimeAttribute($value)
    {
        return DateHelper::formatTime($value);
    }

    public function getAverageRatingAttribute()
    {
        $average = $this->ratings()->avg('rating');
        $average = $average ? ceil($average) : 0;
        return $average > 5 ? 5 : $average;
    }
}
