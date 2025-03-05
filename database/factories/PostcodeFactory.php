<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Postcode>
 */
class PostcodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pcd' => $this->faker->postcode,
            'pcd2' => $this->faker->postcode,
            'pcds' => $this->faker->postcode,
            'dointr' => $this->faker->date('Ymd'),
            'doterm' => $this->faker->optional()->date('Ymd'),
            'oscty' => $this->faker->optional()->word,
            'ced' => $this->faker->optional()->word,
            'oslaua' => $this->faker->optional()->word,
            'osward' => $this->faker->optional()->word,
            'parish' => $this->faker->optional()->word,
            'usertype' => $this->faker->randomElement(['0', '1']),
            'oseast1m' => $this->faker->numberBetween(100000, 999999),
            'osnrth1m' => $this->faker->numberBetween(100000, 999999),
            'osgrdind' => $this->faker->randomElement(['1', '2']),
            'oshlthau' => $this->faker->optional()->word,
            'nhser' => $this->faker->optional()->word,
            'ctry' => $this->faker->countryCode,
            'rgn' => $this->faker->optional()->word,
            'streg' => $this->faker->optional()->word,
            'pcon' => $this->faker->optional()->word,
            'eer' => $this->faker->optional()->word,
            'teclec' => $this->faker->optional()->word,
            'ttwa' => $this->faker->optional()->word,
            'pct' => $this->faker->optional()->word,
            'itl' => $this->faker->optional()->word,
            'statsward' => $this->faker->optional()->word,
            'oa01' => $this->faker->optional()->word,
            'casward' => $this->faker->optional()->word,
            'park' => $this->faker->optional()->word,
            'lsoa01' => $this->faker->optional()->word,
            'msoa01' => $this->faker->optional()->word,
            'ur01ind' => $this->faker->optional()->word,
            'oac01' => $this->faker->optional()->word,
            'oa11' => $this->faker->optional()->word,
            'lsoa11' => $this->faker->optional()->word,
            'msoa11' => $this->faker->optional()->word,
            'wz11' => $this->faker->optional()->word,
            'ccg' => $this->faker->optional()->word,
            'bua11' => $this->faker->optional()->word,
            'buasd11' => $this->faker->optional()->word,
            'ru11ind' => $this->faker->optional()->word,
            'oac11' => $this->faker->optional()->word,
            'lat' => $this->faker->latitude,
            'long' => $this->faker->longitude,
            'lep1' => $this->faker->optional()->word,
            'lep2' => $this->faker->optional()->word,
            'pfa' => $this->faker->optional()->word,
            'imd' => $this->faker->optional()->numberBetween(1, 10000),
            'calncv' => $this->faker->optional()->word,
            'stp' => $this->faker->optional()->word,
            'oa21' => $this->faker->optional()->word,
            'lsoa21' => $this->faker->optional()->word,
            'msoa21' => $this->faker->optional()->word,
        ];
    }
}
