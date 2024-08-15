<?php

namespace App\Livewire\Forms;

use App\Models\Breed;
use Livewire\Form;

class DogForm extends Form
{
    public ?int $breed_id = null;

    public ?string $name = null;

    public ?int $birth_year = null;

    public function rules()
    {
        return [
            'breed_id' => [
                'required',
                'integer',
                'exists:'.Breed::class.',id',
            ],
            'name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'birth_year' => [
                'nullable',
                'integer',
                'min:'.now()->subYears(30)->format('Y'), 'max:'.now()->format('Y'),
            ],
        ];
    }
}
