<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('category')
            ->whereIn('id', $this->ids)
            ->get()
            ->map(function ($product) {
                return [
                    'ID'       => $product->id,
                    'Name'     => $product->name,
                    'Category' => $product->category->name ?? '-',
                    'Price'    => $product->price,
                    'Stock'    => $product->stock,
                    'Enabled'  => $product->enabled ? 'Yes' : 'No',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Category',
            'Price',
            'Stock',
            'Enabled',
        ];
    }
}
