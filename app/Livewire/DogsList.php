<?php

namespace App\Livewire;

use App\Models\Breed;
use App\Models\Dog;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Breed> $breeds
 */
class DogsList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dog> */
    public Collection $dogs;

    public ?int $newDogBreedId = null;

    public ?string $newDogName = null;

    public ?int $newDogBirthYear = null;

    public function mount()
    {
        $this->dogs = $this->user->dogs->load('breed');
    }

    public function render()
    {
        return view('livewire.dogs-list');
    }

    #[Computed()]
    public function user(): ?User
    {
        return Auth::user();
    }

    #[Computed()]
    public function breeds(): Collection
    {
        return Breed::all();
    }

    public function createDog()
    {
        $validated = $this->validate([
            'newDogBreedId' => ['required', 'integer', 'exists:'.Breed::class.',id'],
            'newDogName' => ['required', 'string', 'max:255'],
            'newDogBirthYear' => ['nullable', 'integer', 'min:'.now()->subYears(30)->format('Y'), 'max:'.now()->format('Y')],
        ]);

        $dog = (new Dog)->fill([
            'breed_id' => $validated['newDogBreedId'],
            'name' => $validated['newDogName'],
            'birth_year' => $validated['newDogBirthYear'],
        ]);
        $this->user->dogs()->save($dog);

        $this->mount();
    }

    public function deleteDog(Dog $dog)
    {
        $this->authorize('delete', $dog);

        $dog->delete();

        $this->user->refresh();
        $this->mount();
    }
}
