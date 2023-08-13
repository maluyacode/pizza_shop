<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ChartController extends Controller
{
    public function chart()
    {
        return view('charts.index');
    }

    public function bestSeller()
    {
        $products = Product::with(['orders'])->get();

        $bestSellers = [];

        foreach ($products as $product) {
            $quantity = 0;
            foreach ($product->orders as $order) {
                $quantity += $order->pivot->quantity;
            }
            $bestSellers[$product->name] = $quantity;
        }

        return response()->json($bestSellers);
    }
}
