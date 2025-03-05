<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ShopType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            // Restrict to roughly UK coords
            'latitude' => $this->faker->latitude(50, 58),
            'longitude' => $this->faker->longitude(-10, 2),
            'is_open' => $this->faker->boolean,
            'store_type' => $this->faker->randomElement(ShopType::cases()),
            'max_delivery_distance' => $this->faker->numberBetween(1, 100),
        ];
    }
}
