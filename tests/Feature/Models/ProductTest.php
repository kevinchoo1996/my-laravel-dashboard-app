<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase; // Reset DB for each test

    /** @test */
    public function it_can_create_a_product_with_category()
    {
        // Create a category
        $category = Category::factory()->create([
            'name' => 'Electronics'
        ]);

        // Create a product
        $product = Product::create([
            'name' => 'Smartphone',
            'category_id' => $category->id,
            'price' => 1000,
            'stock' => 125,
            'enabled' => 1,
        ]);

        // Assertions
        $this->assertDatabaseHas('products', [
            'name' => 'Smartphone',
            'category_id' => $category->id
        ]);

        $this->assertEquals('Electronics', $product->category->name);
    }

    /** @test */
    public function product_json_includes_category_id_and_name()
    {
        $category = Category::factory()->create(['name' => 'Electronics']);
        $product = Product::factory()->create(['category_id' => $category->id]);

        $product->load('category');

        $expected = [
            'id' => $product->id,
            'name' => $product->name,
            'category' => [
                'id' => $category->id,
                'name' => 'Electronics'
            ]
        ];

        $this->assertEquals($expected, [
            'id' => $product->id,
            'name' => $product->name,
            'category' => [
                'id' => $product->category->id,
                'name' => $product->category->name
            ]
        ]);
    }
}
