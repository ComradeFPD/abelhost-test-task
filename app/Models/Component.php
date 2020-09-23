<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'components_ingredients',
            'component_id', 'ingredient_id', 'id');
    }
}
