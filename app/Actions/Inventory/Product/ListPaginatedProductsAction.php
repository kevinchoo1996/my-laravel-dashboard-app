<?php

namespace App\Actions\Inventory\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
class ListPaginatedProductsAction
{
    public function execute(Request $request, int $paginationLength): LengthAwarePaginator
    {
        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('enabled')) {
            $query->where('enabled', $request->enabled);
        }

        return $query->paginate($paginationLength);
    }
}
