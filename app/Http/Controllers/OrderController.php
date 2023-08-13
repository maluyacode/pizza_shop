<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(
            Order::with(['products', 'products.media', 'user', 'payment'])->get()
        );
    }

    public function confirm($id)
    {
        $order = Order::find($id);
        $order->status = 'confirmed';
        $order->save();
        return back()->with('success', 'Order #' . $order->id . ' confirmed');
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->status = 'cancelled';
        $order->save();
        return back()->with('success', 'Order #' . $order->id . ' cancelled');
    }

    public function shipped($id)
    {
        $order = Order::find($id);
        $order->status = 'shipped';
        $order->save();
        return back()->with('success', 'Order #' . $order->id . ' shipped');
    }

    public function delivered($id)
    {
        $order = Order::find($id);
        $order->status = 'delivered';
        $order->save();
        return back()->with('success', 'Order #' . $order->id . ' delivered');
    }

    public function deleteOrder($id)
    {
        Order::destroy($id);
        return back()->with('success', 'Order #' . $id . ' deleted');
    }
}
