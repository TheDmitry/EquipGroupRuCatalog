<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Product;
use App\Models\Price;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Group::factory()->count(10)->create();

        Group::all()->each(function ($group) {
            Group::factory()
                ->count(rand(0, 3))
                ->create(['id_parent' => $group->id()]);
        });

        Product::factory()->count(50)->create();

        Price::factory()->count(50)->create();
    }
}
