<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controller\Admin;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_denies_unauthorised(): void
    {
        $response = $this->get(route('shops.index'));

        $response->assertStatus(302); // Redirect to login
    }

    public function test_allows_authorised(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('shops.index'));

        $response->assertOk();
    }

    public function test_can_list_shops(): void
    {
        $this->actingAs(User::factory()->create());

        Shop::factory()->count(5)->create();
        $this->assertDatabaseCount('shops', 5);

        $response = $this->get(route('shops.index'));

        $response->assertOk();
        $response->assertSeeText('Shops');

        $this->assertCount(5, $response->viewData('shops'));
    }
}
