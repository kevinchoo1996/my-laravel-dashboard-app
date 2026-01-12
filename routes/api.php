<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Inventory\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('inventory')->name('api-inventory.')->group(function () {
            Route::delete('products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk-delete');
            Route::apiResource('products', ProductController::class);
    });
});