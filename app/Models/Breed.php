<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\BreedFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Breed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Breed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Breed query()
 * @method static \Illuminate\Database\Eloquent\Builder|Breed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Breed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Breed whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Breed whereUpdatedAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dog> $dogs
 * @property-read int|null $dogs_count
 *
 * @mixin \Eloquent
 */
class Breed extends Model
{
    use HasFactory;

    public function dogs(): HasMany
    {
        return $this->hasMany(Dog::class);
    }
}
