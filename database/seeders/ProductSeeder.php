<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        // Ensure we have categories seeded
        if ($categories->count() === 0) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        // Create 10 sample products
        foreach (range(1, 10) as $i) {
            Product::create([
                'name' => "Product $i",
                'description' => "This is the description for Product $i.",
                'price' => rand(10, 500), // random price
                'stock' => rand(1, 100),
                'enabled' => true,
                'category_id' => $categories->random()->id,
                'created_by' => 1, // replace with actual admin ID
                'updated_by' => 1
            ]);
        }
    }
}
