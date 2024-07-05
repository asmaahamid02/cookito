<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'unit',
    ];

    protected $appends = [
        'formatted_quantity',
        'formatted_name',
    ];

    ########### Relationships ###########
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    ########### Accessors ###########
    public function getFormattedQuantityAttribute()
    {
        return $this->quantity . ' ' . $this->unit;
    }

    public function getFormattedNameAttribute()
    {
        return $this->quantity . ' ' . $this->unit . ' ' . $this->name;
    }
}
