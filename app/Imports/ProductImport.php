<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name'  => $row['name'],
            'price'  => $row['price'],
            'detail'  => $row['detail'],
            'img_path'  => $row['img_path'],
            'category_id'  => $row['category_id'],
        ]);
    }
}
