<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Group;
use App\Models\Product;
use App\Models\Price;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        Group::factory()->create(['id_parent' => 0]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_catalog_index_shows_groups_and_products(): void
    {
        $group = Group::factory()->create(['id_parent' => 0, 'name' => 'Крутая группа']);
        $product = Product::factory()->create(['id_group' => $group->id, 'name' => 'Товар еще круче']);
        Price::factory()->create(['id_product' => $product->id, 'price' => 404.55]);

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Крутая группа')
            ->assertSee('Товар еще круче')
            ->assertSee('404.55');
    }

    public function test_group_page_shows_group_products_and_subgroup_products(): void
    {
        $root = Group::factory()->create(['id_parent' => 0, 'name' => 'Корень']);
        $child = Group::factory()->create(['id_parent' => $root->id, 'name' => 'Подгруппа']);
        $other = Group::factory()->create(['id_parent' => 0, 'name' => 'Подгруппа поменьше']);

        $rootProduct = Product::factory()->create(['id_group' => $root->id, 'name' => 'Рыба']);
        $childProduct = Product::factory()->create(['id_group' => $child->id, 'name' => 'Почти рыба']);
        $otherProduct = Product::factory()->create(['id_group' => $other->id, 'name' => 'Картошка']);

        Price::factory()->create(['id_product' => $rootProduct->id, 'price' => 12.3]);
        Price::factory()->create(['id_product' => $childProduct->id, 'price' => 45.6]);
        Price::factory()->create(['id_product' => $otherProduct->id, 'price' => 78.9]);

        $response = $this->get("/group/{$root->id}");

        $response->assertStatus(200)
            ->assertSee('Рыба')
            ->assertSee('Почти рыба')
            ->assertDontSee('Картошка');
    }

    public function test_product_page_displays_breadcrumbs(): void
    {
        $root = Group::factory()->create(['id_parent' => 0, 'name' => 'Корень ли?']);
        $child = Group::factory()->create(['id_parent' => $root->id, 'name' => 'Точно подгруппа']);
        $product = Product::factory()->create(['id_group' => $child->id, 'name' => 'Продукт']);
        Price::factory()->create(['id_product' => $product->id, 'price' => 5321.4]);

        $response = $this->get("/product/{$product->id}");

        $response->assertStatus(200)
            ->assertSee('Продукт')
            ->assertSee('Точно подгруппа')
            ->assertSee('Корень ли?');
    }
}
