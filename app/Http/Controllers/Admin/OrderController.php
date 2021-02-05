<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function placedOrderDetails()
    {
        $order = Order::all();
        // dd($order);
        return view('admin.placedOrder', compact('order'));
    }

    public function orderDetails($id)
    {
        $order = Order::findorfail($id);
        $orderItem = OrderItem::where('order_id', $order->id)->get();
        return view('admin.orderDetail', compact('order', 'orderItem'));
    }
}
