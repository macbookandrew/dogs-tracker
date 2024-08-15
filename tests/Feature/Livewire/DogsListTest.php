<?php

namespace Tests\Feature\Livewire;

use App\Livewire\DogsList;
use App\Models\Dog;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class DogsListTest extends TestCase
{
    public function test_authentication(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function test_displays_empty_message(): void
    {
        $user = User::factory()->create();
        $otherUserDog = Dog::factory()->create();
        $this->assertFalse($otherUserDog->user->is($user));

        Livewire::actingAs($user)
            ->test(DogsList::class)
            ->assertOk()
            ->assertSee('add your first')
            ->assertDontSee($otherUserDog->name);
    }

    public function test_displays_users_dogs(): void
    {
        $user = User::factory()->create();
        $dogs = Dog::factory()->times(3)->for($user)->create();

        $otherUserDog = Dog::factory()->create();
        $this->assertFalse($otherUserDog->user->is($user));

        Livewire::actingAs($user)
            ->test(DogsList::class)
            ->assertOk()
            ->assertSee([
                $dogs[0]->breed->name,
                $dogs[0]->name,
                $dogs[0]->birth_year ?? '—',

                $dogs[1]->breed->name,
                $dogs[1]->name,
                $dogs[1]->birth_year ?? '—',

                $dogs[2]->breed->name,
                $dogs[2]->name,
                $dogs[2]->birth_year ?? '—',
            ])
            ->assertDontSee($otherUserDog->name);
    }
}
