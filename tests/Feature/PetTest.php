<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_pets(): void
    {
        $this->get(route('pets.index'))
            ->assertRedirect(route('login'));

        $this->get(route('pets.create'))
            ->assertRedirect(route('login'));

        $this->post(route('pets.store'), [
            'name' => 'Buddy',
            'species' => 'Dog',
        ])->assertRedirect(route('login'));

        $this->assertDatabaseCount('pets', 0);
    }

    public function test_customer_can_add_their_own_pet(): void
    {
        $customer = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($customer)
            ->post(route('pets.store'), [
                'name' => 'Buddy',
                'species' => 'Dog',
                'breed' => 'Labrador',
                'user_id' => $otherUser->id,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('pets.index'));

        $this->assertDatabaseHas('pets', [
            'name' => 'Buddy',
            'user_id' => $customer->id,
        ]);

        $this->assertDatabaseMissing('pets', [
            'name' => 'Buddy',
            'user_id' => $otherUser->id,
        ]);
    }

    public function test_customer_sees_only_their_own_pets(): void
    {
        $customer = User::factory()->create();
        $otherUser = User::factory()->create();

        $customer->pets()->create([
            'name' => 'Buddy',
            'species' => 'Dog',
        ]);

        $otherUser->pets()->create([
            'name' => 'Whiskers',
            'species' => 'Cat',
        ]);

        $this->actingAs($customer)
            ->get(route('pets.index'))
            ->assertOk()
            ->assertSeeText('Buddy')
            ->assertDontSeeText('Whiskers');
    }

    public function test_invalid_pet_is_not_saved(): void
    {
        $customer = User::factory()->create();

        $this->actingAs($customer)
            ->post(route('pets.store'), [
                'name' => '',
                'species' => 'Invalid species',
            ])->assertSessionHasErrors(['name', 'species']);

        $this->assertDatabaseCount('pets', 0);
    }
}