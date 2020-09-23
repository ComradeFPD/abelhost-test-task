<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function components()
    {
        return $this->belongsToMany(Component::class, 'cakes_components', 'cake_id',
            'component_id', 'id');
    }
}
