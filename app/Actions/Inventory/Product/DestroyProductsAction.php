<?php

namespace App\Actions\Inventory\Product;

use App\Models\Product;

class DestroyProductsAction
{
    public function execute(array $ids): void
    {
        Product::whereIn('id', $ids)->delete();
    }
}
