<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucwords(join ('', fake()->words(2))),
            'description' => fake()->paragraph(5),
            'address' => fake()->address(),
            'luas' => fake()->randomNumber(2, true),
            'wifi_speed' => fake()->randomNumber(2, true),
            'kapasitas' => fake()->numberBetween(1, 10),
            'harga_per_hari' => fake()->randomNumber(6, true),
            'full_support' => fake()->boolean(),
            'tersedia_mini_cafe' => fake()->boolean(),
            'tersedia_gym' => fake()->boolean(),
        ];
    }
}
