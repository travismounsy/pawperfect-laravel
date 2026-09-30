<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_services(): void
    {
        Service::create([
            'name' => 'Bath and Brush',
            'price' => 30,
        ]);

        $this->get(route('services.index'))
            ->assertOk()
            ->assertSeeText('Bath and Brush')
            ->assertSeeText('$30.00');
    }

    public function test_service_can_be_created(): void
    {
        $this->post(route('services.store'), [
            'name' => 'Full Grooming',
            'price' => 60,
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('services.index'));

        $this->assertDatabaseHas('services', [
            'name' => 'Full Grooming',
            'price' => 60,
        ]);
    }

    public function test_invalid_service_is_not_created(): void
    {
        $this->post(route('services.store'), [
            'name' => '',
            'price' => -10,
        ])->assertSessionHasErrors(['name', 'price']);

        $this->assertDatabaseCount('services', 0);
    }

    public function test_edit_form_displays_existing_service(): void
    {
        $service = Service::create([
            'name' => 'Nail Trimming',
            'price' => 15,
        ]);

        $this->get(route('services.edit', $service))
            ->assertOk()
            ->assertViewIs('services.edit')
            ->assertSee('Nail Trimming');
    }

    public function test_service_can_be_updated(): void
    {
        $service = Service::create([
            'name' => 'Bath and Brush',
            'price' => 30,
        ]);

        $this->put(route('services.update', $service), [
            'name' => 'Deluxe Bath',
            'price' => 40,
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('services.index'));

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Deluxe Bath',
            'price' => 40,
        ]);
    }

    public function test_invalid_update_preserves_existing_service(): void
    {
        $service = Service::create([
            'name' => 'Bath and Brush',
            'price' => 30,
        ]);

        $this->put(route('services.update', $service), [
            'name' => '',
            'price' => -5,
        ])->assertSessionHasErrors(['name', 'price']);

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Bath and Brush',
            'price' => 30,
        ]);
    }

    public function test_service_can_be_deleted(): void
    {
        $service = Service::create([
            'name' => 'Temporary Service',
            'price' => 10,
        ]);

        $this->delete(route('services.destroy', $service))
            ->assertRedirect(route('services.index'));

        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }

    public function test_editing_missing_service_returns_404(): void
    {
        $this->get(route('services.edit', 999999))
            ->assertNotFound();
    }
}