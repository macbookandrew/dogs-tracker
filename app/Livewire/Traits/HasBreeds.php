<?php

namespace App\Livewire\Traits;

use App\Models\Breed;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Breed> $breeds
 */
trait HasBreeds
{
    #[Computed()]
    public function breeds(): Collection
    {
        return Breed::all();
    }
}
