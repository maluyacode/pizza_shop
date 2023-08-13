<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addCart($id)
    {

        $product = Product::find($id);

        $producsCart =  [
            'product_id' => $product->id,
            'quantity' => 1,
            'product_price' => $product->price,
        ];

        $cart = Session::get('cart') || null;

        if ($cart) {
        }

        if (!$cart) {

        }
    }
}
