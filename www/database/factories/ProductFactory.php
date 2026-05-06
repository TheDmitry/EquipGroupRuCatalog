<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_group' => Group::inRandomOrder()->first()?->id ?? Group::factory(),
            'name' => fake()->word(),
        ];
    }
}
