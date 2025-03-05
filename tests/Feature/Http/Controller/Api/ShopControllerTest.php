<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controller\Api;

use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Once we implement Laravel Sanctum, this test should fail
     */
    public function test_is_public(): void
    {
        $response = $this->get(route('api.shops.index'));

        $response->assertOk();
    }

    public function test_can_list_shops(): void
    {
        Shop::factory()->count(5)->create();
        $this->assertDatabaseCount('shops', 5);

        $response = $this->get(route('api.shops.index'));

        $response->assertOk();
        $response->assertJsonCount(5);

        $data = $response->json();
        $this->assertArrayHasKey('latitude', $data[0]);
        $this->assertArrayHasKey('longitude', $data[0]);
    }
}
