<?php

namespace App\Livewire;

use App\Livewire\Forms\DogForm;
use App\Livewire\Traits\HasBreeds;
use App\Models\Dog as DogModel;
use Livewire\Component;

class Dog extends Component
{
    use HasBreeds;

    public DogModel $dog;

    public DogForm $form;

    public bool $editing = false;

    public function mount()
    {
        $this->form->fill($this->dog->getAttributes());
    }

    public function render()
    {
        return view('livewire.dog');
    }

    public function save()
    {
        $this->authorize('update', $this->dog);

        $data = $this->form->validate($this->form->rules());

        $this->dog->update($data);

        $this->editing = false;

        $this->dispatch('saved');
    }

    public function delete()
    {
        $this->authorize('delete', $this->dog);

        $this->dog->delete();

        $this->dispatch('deleted');
    }
}
