<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_product' => Product::inRandomOrder()->first()->value('id') ?? Product::factory()->create()->id,
            'price' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
