<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\View;

class FrontEndController extends Controller
{

    public function categories()
    {
        return View::make('home', ['categories' => Category::with(['media'])->get()]);
    }

    public function ViewAllProduct($id)
    {
        $category = Category::find($id);
        $products = Product::with('media')->where('category_id', $id)->get();

        return View::make('viewProduct', compact('products', 'category'));
    }

    public function product($id)
    {
        return View::make('product-details', ['product' => Product::with('media')->find($id)]);
    }
}
