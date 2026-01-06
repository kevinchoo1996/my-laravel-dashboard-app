<?php

namespace App\Actions\Inventory\Product;

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportProductsAction
{
    public function execute(array $ids)
    {
        return Excel::download(new ProductsExport($ids), 'products.xlsx');
    }
}
