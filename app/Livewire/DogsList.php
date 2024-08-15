<?php

namespace App\Livewire;

use App\Livewire\Traits\HasBreeds;
use App\Livewire\Traits\HasUser;
use App\Models\Breed;
use App\Models\Dog;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class DogsList extends Component
{
    use HasBreeds;
    use HasUser;

    /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dog> */
    public Collection $dogs;

    public ?int $newDogBreedId = null;

    public ?string $newDogName = null;

    public ?int $newDogBirthYear = null;

    #[On(['saved', 'deleted'])]
    public function mount()
    {
        $this->dogs = $this->user->dogs->load('breed');
    }

    public function render()
    {
        return view('livewire.dogs-list');
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

        $this->reset(['newDogBreedId', 'newDogName', 'newDogBirthYear']);
        $this->dispatch('saved');
    }
}
