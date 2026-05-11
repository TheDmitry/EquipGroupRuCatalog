<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Group;
use App\Models\Product;
use App\Models\Price;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_group_get_path_returns_parent_hierarchy(): void
    {
        $root = Group::factory()->create(['id_parent' => 0]);
        $child = Group::factory()->create(['id_parent' => $root->id]);

        $this->assertSame([$root->id, $child->id], $child->getPath());
    }

    public function test_group_get_children_ids_returns_descendant_ids(): void
    {
        $root = Group::factory()->create(['id_parent' => 0]);
        $child = Group::factory()->create(['id_parent' => $root->id]);
        $grandchild = Group::factory()->create(['id_parent' => $child->id]);

        $this->assertSame([$root->id, $child->id, $grandchild->id], $root->getChildrenIds());
    }

    public function test_product_formatted_price_attribute(): void
    {
        $product = Product::factory()->create();
        $product->price()->create(['price' => 123.45]);

        $this->assertSame('123.45 ₽', $product->fresh()->formattedPrice);
    }
}
