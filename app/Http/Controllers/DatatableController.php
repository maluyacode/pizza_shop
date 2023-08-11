<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CustomerDataTable;
use App\DataTables\CategoryDataTable;
use App\DataTables\ProductDataTable;

class DatatableController extends Controller
{
    public function customerDatatable(CustomerDataTable $dataTable)
    {
        return $dataTable->render('customer.datatable');
    }

    public function productDatatable(ProductDataTable $dataTable)
    {
        return $dataTable->render('product.datatable');
    }

    public function categoryDatatable(CategoryDataTable $dataTable)
    {
        return $dataTable->render('category.datatable');
    }
}
