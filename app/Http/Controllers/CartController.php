<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Stock;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Events\EmailCheckoutEvent;

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
        // Session::save();
        // dd(Session::all());
        $cart = Session::get('cart', []);
        $payments = Payment::pluck('name', 'id');
        // dd($payments);
        return view('user.cart', compact('cart', 'payments'));
    }

    public function addQuantity($id)
    {
        $cart = Session::get('cart');

        $quantity = $cart[$id]["quantity"]  + 1;
        $cart[$id]["quantity"] =  $quantity;
        Session::put('cart', $cart);
        Session::save();
        $cart = Session::get('cart');
        return response()->json(['quantity' => $quantity, 'price' => $cart[$id]["product_price"], 'cart' => $cart]);
    }
    public function subQuantity($id)
    {
        $cart = Session::get('cart');

        if ($cart[$id]["quantity"] <= 1) {
            return response('', 404);
        }

        $quantity = $cart[$id]["quantity"]  - 1;
        $cart[$id]["quantity"] =  $quantity;
        Session::put('cart', $cart);
        Session::save();
        $updatecart = Session::get('cart');
        return response()->json(['quantity' => $quantity, 'price' => $cart[$id]["product_price"], 'cart' => $updatecart]);
    }

    public function removeItem($id)
    {
        $cart = Session::get('cart');
        $name = $cart[$id]["product_name"];
        unset($cart[$id]);

        Session::put('cart', $cart);
        Session::save();

        return back()->with('success', $name . ' Succesfully remove from cart');
    }

    public function removeAll()
    {
        Session::forget('cart');
        return back()->with('success', 'All products succesfully remove from cart');
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();
        try {

            $order = new Order;
            $order->order_date = now();
            $order->status = 'pending';
            $order->address = $request->address;
            $order->user_id = Auth::user()->id;
            $order->payment_id = $request->payment_id;
            $order->save();

            $cart = Session::get('cart');
            foreach ($cart as $productId => $product) {
                $order->products()->attach($productId, ['quantity' => $product["quantity"]]);

                $stock = Stock::where('product_id', $productId)->first();
                $stock->quantity = $stock->quantity - $product["quantity"];
                $stock->save();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Debugbar::info($e);
            return back()->with('warning', 'Add your product first');
        }
        Session::forget('cart');
        DB::commit();

        EmailCheckoutEvent::dispatch($order);

        return back()->with('success', 'Successfully checkout, we will send you an email once we review your order. Thank you!');
    }
}
