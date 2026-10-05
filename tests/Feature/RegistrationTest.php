<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_is_available(): void
    {
        $this->get(route('register'))->assertOk();
    }

    public function test_customer_can_register(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Sample Customer',
            'email' => 'customer@example.com',
            'password' => 'PawPerfect123!',
            'password_confirmation' => 'PawPerfect123!',
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('services.index'));

        $user = User::where('email', 'customer@example.com')->firstOrFail();

        $this->assertSame('Sample Customer', $user->name);
        $this->assertFalse($user->is_admin);
        $this->assertTrue(Hash::check('PawPerfect123!', $user->password));
        $this->assertAuthenticatedAs($user);
    }

    public function test_registration_cannot_grant_admin_access(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Sample Customer',
            'email' => 'customer@example.com',
            'password' => 'PawPerfect123!',
            'password_confirmation' => 'PawPerfect123!',
            'is_admin' => true,
        ])->assertSessionHasNoErrors();

        $user = User::where('email', 'customer@example.com')->firstOrFail();

        $this->assertFalse($user->is_admin);

        $this->get(route('services.create'))->assertForbidden();
    }

    public function test_duplicate_email_is_rejected(): void
    {
        User::factory()->create([
            'email' => 'customer@example.com',
        ]);

        $this->post(route('register.store'), [
            'name' => 'Another Customer',
            'email' => 'customer@example.com',
            'password' => 'PawPerfect123!',
            'password_confirmation' => 'PawPerfect123!',
        ])->assertSessionHasErrors('email');

        $this->assertDatabaseCount('users', 1);
        $this->assertGuest();
    }

    public function test_password_confirmation_must_match(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Sample Customer',
            'email' => 'customer@example.com',
            'password' => 'PawPerfect123!',
            'password_confirmation' => 'DifferentPassword123!',
        ])->assertSessionHasErrors('password');

        $this->assertDatabaseCount('users', 0);
        $this->assertGuest();
    }
}