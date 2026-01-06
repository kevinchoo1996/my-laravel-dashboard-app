<?php

namespace App\Actions\Inventory\Category;

use App\Models\Category;
use Illuminate\Support\Collection;

class ListCategoriesAction
{
    public function execute(): Collection
    {
        return Category::orderBy('name')->get();
    }
}
