<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Spatie\Searchable\Search;
use App\Models\Category;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Category::class, ['name'])
            ->registerModel(Product::class, ['name'])
            ->search(trim($request->term));

        return View::make('search-result', compact('searchResults'));
    }

    public function searchData()
    {
        return response()->json([
            "products" => Product::pluck('name'),
            "categories" => Category::pluck('name'),
        ]);
    }
}
