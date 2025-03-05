<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controller\Api;

use App\Models\Postcode;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Sequence;
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

    public function test_can_exclude_shops_outside_radius(): void
    {
        Shop::factory()
            ->state(new Sequence(
                ['is_open' => true, 'latitude' => 51.123, 'longitude' => -1.123],
                ['is_open' => true, 'latitude' => 51.456, 'longitude' => -1.456],
                ['is_open' => true, 'latitude' => 54.789, 'longitude' => 1.789],
            ))
            ->count(3)
            ->create();
        $this->assertDatabaseCount('shops', 3);

        Postcode::factory()
            ->state(new Sequence(
                ['pcd' => 'LS12 6LX', 'lat' => 53.7786817, 'long' => -1.554589]
            ))
            ->count(1)
            ->create();
        $this->assertDatabaseCount('postcodes', 1);

        $response = $this->get(route('api.shops.index', ['postcode' => 'LS12 6LX']));

        $response->assertOk();
        $response->assertJsonCount(0);
    }

    public function test_includes_shops_inside_radius(): void
    {
        Shop::factory()
            ->state(new Sequence(
                ['is_open' => true, 'latitude' => 51.123, 'longitude' => -1.123],
                ['is_open' => true, 'latitude' => 51.456, 'longitude' => -1.456],
                ['is_open' => true, 'latitude' => 54.789, 'longitude' => 1.789],
            ))
            ->count(3)
            ->create();
        $this->assertDatabaseCount('shops', 3);

        Postcode::factory()
            ->state(new Sequence(
                ['pcd' => 'GU34 5LU', 'lat' => 51.1294971, 'long' => -1.0672874]
            ))
            ->count(1)
            ->create();
        $this->assertDatabaseCount('postcodes', 1);

        $response = $this->get(route('api.shops.index', ['postcode' => 'GU34 5LU']));

        $response->assertOk();
        $response->assertJsonCount(2);
    }
}
