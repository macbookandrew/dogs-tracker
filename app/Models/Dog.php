<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $App\Models\Breed
 * @property int $App\Models\User
 * @property string $name
 * @property string|null $birth_year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Breed|null $breed
 * @property-read \App\Models\User|null $user
 *
 * @method static \Database\Factories\DogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Dog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereApp\Models\Breed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereApp\Models\User($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Dog extends Model
{
    use HasFactory;

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
