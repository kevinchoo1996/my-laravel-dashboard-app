<?php

namespace App\Actions\Inventory\Product;

use App\Models\Product;

class UpdateProductAction
{
    public function execute(Product $product, array $updateRequest): Product
    {
        $product->update($updateRequest);
        return $product;
    }
}
