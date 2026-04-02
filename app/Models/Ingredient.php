<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['name', 'category', 'default_unit'];

    public function recipes() {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients')
                    ->withPivot('quantity', 'unit');
    }
}
