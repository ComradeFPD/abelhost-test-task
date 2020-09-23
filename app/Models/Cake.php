<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cake
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Component[] $components
 * @property-read int|null $components_count
 * @method static \Illuminate\Database\Eloquent\Builder|Cake newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cake newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cake query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cake whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cake whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cake whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cake whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cake extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * Cake components
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function components()
    {
        return $this->belongsToMany(Component::class, 'cakes_components', 'cake_id',
            'component_id', 'id');
    }
}
