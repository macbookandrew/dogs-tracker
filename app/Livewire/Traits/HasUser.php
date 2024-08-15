<?php

namespace App\Livewire\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;

/**
 * @property-read \App\Models\User $user
 */
trait HasUser
{
    #[Computed()]
    public function user(): ?User
    {
        return Auth::user();
    }
}
