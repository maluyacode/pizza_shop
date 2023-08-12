<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\View;

class FrontEndController extends Controller
{
    public function ViewAllProduct(){
        $product = Product::with('media')->get();
        return View::make('viewProduct', compact('product'));
    }
}
