<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Setting;
use App\Models\Trades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminLiveOrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::orderBy('created_at', 'desc')->get();
        $market = Setting::where("s_key","market_status")->value('s_value');
        return view('liveorders_admin' , compact('orders','market'));
    }
    function generate_number($length)
    {
        $min = pow(10, $length - 1) ;
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);
    }
    public function orderSave(Request $request)
    {
        $order_id = $request->order_id;
        $order = Orders::find($order_id);
        Log::debug($order);
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
        return redirect()->route('admin-liveorders', );
    }
}
