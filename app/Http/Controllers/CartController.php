<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addCart($id)
    {
        $cart = Session::get('cart', []);

        if (array_key_exists($id, $cart)) {
            return back()->with('warning', 'The product exist in your cart');
        }

        $product = Product::find($id);

        $producsCart =  [
            'product_id' => $product->id,
            'quantity' => 1,
            'product_price' => $product->price,
            'product_name' => $product->name,
        ];

        $cart[$id] = $producsCart;

        Session::put('cart', $cart);
        Session::save();

        return back()->with('success', 'Successfully added to cart, you may check you cart and edit.');
    }

    public function viewCart()
    {
        // Session::forget('cart');
        $cart = Session::get('cart', []);
        $payments = Payment::pluck('name', 'id');
        // dd($payments);
        return view('user.cart', compact('cart', 'payments'));
    }
}
