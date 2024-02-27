<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Trades;

class AdminOrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
        return view('admin_orders' , compact('orders'));
    }
    function generate_number($length)
    {
        $min = pow(10, $length - 1) ;
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);
    }
    public function orderSave($order_id)
    {
        $order = Orders::find($order_id);
        $number = $this->generate_number(5);
        while (Trades::where('number', $number)->exists())
        {
            $number = $this->generate_number(5);
        }
        Trades::create([
            "value" => $order->value,
            "fee" => $order->fee,
            "total_price" => $order->total_price,
            "number" => $number,
            "type" => $order->type,
            "user_id" => $order->user_id,
            "product_id" => $order->product_id
        ]);
        return redirect()->route('admin-orders', );
    }

}
