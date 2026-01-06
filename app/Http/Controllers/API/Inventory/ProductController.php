<?php

namespace App\Http\Controllers\API\Inventory;

use App\Actions\Inventory\Product\DestroyProductsAction;
use App\Actions\Inventory\Product\ExportProductsAction;
use App\Actions\Inventory\Category\ListCategoriesAction;
use App\Actions\Inventory\Product\ListPaginatedProductsAction;
use App\Actions\Inventory\Product\StoreProductAction;
use App\Actions\Inventory\Product\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\Product\BulkDeleteProductRequest;
use App\Http\Requests\Inventory\Product\ExportProductRequest;
use App\Models\Product;
use App\Http\Requests\Inventory\Product\StoreProductRequest;
use App\Http\Requests\Inventory\Product\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ListPaginatedProductsAction $listPaginatedProductsAction,
        protected ListCategoriesAction $listCategoriesAction,
        protected StoreProductAction $storeProductAction,
        protected UpdateProductAction $updateProductAction,
        protected DestroyProductsAction $destroyProductsAction,
        protected ExportProductsAction $exportProductsAction
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);
        return $this->listPaginatedProductsAction->execute($request, 10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create');
        return $this->storeProductAction->execute($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);
        return $product;
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        return $this->updateProductAction->execute($product, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $this->destroyProductsAction->execute([$product->id]);

        return "Product deleted successfully.";
    }

    public function bulkDelete(BulkDeleteProductRequest $request)
    {
        $this->authorize('bulkDelete');
        $this->destroyProductsAction->execute($request->input('selected'));
        return redirect()->back()->with('success', 'Selected products deleted successfully.');
    }
}
