<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // return new Product([
        //     'name'  => $row['name'],
        //     'price'  => $row['price'],
        //     'detail'  => $row['detail'],
        //     'img_path'  => $row['img_path'],
        //     'category_id'  => $row['category_id'],
        // ]);
        foreach ($rows as $row) {
            $product =  Product::create([
                'name'  => $row['name'],
                'price'  => $row['price'],
                'detail'  => $row['detail'],
                'img_path'  => $row['img_path'],
                'category_id'  => $row['category_id'],
            ]);
            $stock = new Stock;
            $stock->product_id = $product->id;
            $stock->quantity = 0;
            $stock->save();
        }
    }
}
