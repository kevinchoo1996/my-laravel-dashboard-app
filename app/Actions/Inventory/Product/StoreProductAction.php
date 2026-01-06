<?php

namespace App\Actions\Inventory\Product;

use App\Models\Product;

class StoreProductAction
{
    public function execute(array $storeRequest): Product
    {
        return Product::create($storeRequest);
    }
}
