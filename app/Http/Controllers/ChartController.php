<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Payment;

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
    public function categoriesProduct()
    {

        $categories = Category::with(['products'])->get();

        $categoriesProduct = [];
        foreach ($categories as $category) {
            $categoriesProduct[$category->name] = count($category->products);
        }

        return response()->json($categoriesProduct);
    }

    public function mostPaymentMethod()
    {
        $payments = Payment::with(['orders'])->get();

        $mostChoosePayment = [];

        foreach ($payments as $payment) {
            $mostChoosePayment[$payment->name] = count($payment->orders);
        }

        return response()->json($mostChoosePayment);
    }
}
