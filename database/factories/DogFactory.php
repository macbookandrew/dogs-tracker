<?php

namespace Database\Factories;

use App\Models\Breed;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'breed_id' => Breed::factory(),
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'birth_year' => fake()->boolean(90) ? fake()->year() : null,
        ];
    }
}
