<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Books',
            'Clothing',
            'Toys',
            'Furniture'
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
