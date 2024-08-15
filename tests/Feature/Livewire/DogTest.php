<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Dog;
use App\Models\Breed;
use App\Models\Dog as DogModel;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class DogTest extends TestCase
{
    public function test_renders_successfully(): void
    {
        $dog = DogModel::factory()->create();

        Livewire::test(Dog::class, ['dog' => $dog])
            ->assertOk()
            ->assertSeeInOrder([
                $dog->breed->name,
                $dog->name,
                $dog->birth_year ?? '—',
            ]);
    }

    public function test_validation(): void
    {
        $user = User::factory()->create();
        $dog = DogModel::factory()->for($user)->create();

        Livewire::actingAs($user)
            ->test(Dog::class, ['dog' => $dog])
            ->assertOk()
            ->assertSee($dog->name)

            ->fill([
                'form.breed_id' => null,
                'form.name' => null,
            ])
            ->call('save')
            ->assertHasErrors([
                'form.breed_id' => 'required',
                'form.name' => 'required',
            ]);

        $this->assertEquals($dog->name, $dog->fresh()->name);
    }

    public function test_user_can_edit_own_dog(): void
    {
        $user = User::factory()->create();
        $dog = DogModel::factory()->for($user)->create();

        $newBreed = Breed::factory()->create();

        Livewire::actingAs($user)
            ->test(Dog::class, ['dog' => $dog])
            ->assertOk()
            ->assertSee($dog->name)

            ->fill([
                'form.breed_id' => $newBreed->id,
                'form.name' => 'New Name',
                'form.birth_year' => 2010,
            ])
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('saved');

        $this->assertDatabaseHas(DogModel::class, [
            'id' => $dog->id,
            'breed_id' => $newBreed->id,
            'name' => 'New Name',
            'birth_year' => 2010,
        ]);
    }

    public function test_user_can_not_edit_other_dogs(): void
    {
        $user = User::factory()->create();
        $otherUserDog = DogModel::factory()->create();
        $this->assertFalse($otherUserDog->user->is($user));

        $newBreed = Breed::factory()->create();

        Livewire::actingAs($user)
            ->test(Dog::class, ['dog' => $otherUserDog])
            ->fill([
                'form.breed_id' => $newBreed->id,
                'form.name' => 'New Name',
                'form.birth_year' => 2010,
            ])
            ->call('save')
            ->assertForbidden()
            ->assertNotDispatched('saved');

        $this->assertEquals($otherUserDog->name, $otherUserDog->fresh()->name);
    }

    public function test_user_can_delete_own_dog(): void
    {
        $user = User::factory()->create();
        $dog = DogModel::factory()->for($user)->create();

        Livewire::actingAs($user)
            ->test(Dog::class, ['dog' => $dog])
            ->assertOk()
            ->assertSee($dog->name)

            ->call('delete')
            ->assertHasNoErrors()
            ->assertDispatched('deleted');

        $this->assertModelMissing($dog);
    }

    public function test_user_cannot_delete_other_dogs(): void
    {
        $user = User::factory()->create();
        $otherUserDog = DogModel::factory()->create();
        $this->assertFalse($otherUserDog->user->is($user));

        Livewire::actingAs($user)
            ->test(Dog::class, ['dog' => $otherUserDog])
            ->assertOk()
            ->assertSee($otherUserDog->name)

            ->call('delete')
            ->assertForbidden()
            ->assertNotDispatched('deleted');

        $this->assertModelExists($otherUserDog);
    }
}
