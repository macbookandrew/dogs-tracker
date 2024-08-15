<?php

namespace Tests\Feature\Models;

use App\Models\Dog;
use App\Models\User;
use Tests\TestCase;

class DogTest extends TestCase
{
    public function test_policy(): void
    {
        $user = User::factory()->create();
        $dog = Dog::factory()->for($user)->create();

        $otherUserDog = Dog::factory()->create();
        $this->assertFalse($otherUserDog->user->is($user));

        $this->assertTrue($user->can('view', $dog));
        $this->assertFalse($user->can('view', $otherUserDog));

        $this->assertTrue($user->can('update', $dog));
        $this->assertFalse($user->can('update', $otherUserDog));

        $this->assertTrue($user->can('delete', $dog));
        $this->assertFalse($user->can('delete', $otherUserDog));

        $this->assertTrue($user->can('restore', $dog));
        $this->assertFalse($user->can('restore', $otherUserDog));

        $this->assertTrue($user->can('forceDelete', $dog));
        $this->assertFalse($user->can('forceDelete', $otherUserDog));

        $this->assertTrue($user->can('create', Dog::class));
    }
}
