<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Psy\debug;

class OrderController extends Controller
{
    public function index($product_id,$type)
    {
        $products = Products::all();
        $product = Products::find($product_id);
        //("id",$product_id)->value("title","buy_price","sell_price","status","unit");
//        Log::debug($product);
        $market = Setting::where("s_key","market_status")->value('s_value');
        $user_id = 1;
        return view("order",compact('market','products','product','type','user_id'));
    }
    public function store(Request $request)
    {
//        Log::debug($request);
        Orders::create([
            "value" => $request->amount,
            "fee" => $request->product_fee,
            "total_price" => $request->input_price,
            "status" => 0,
            "type" => $request->operation_type,
            "user_id" => 1,
            "product_id" => $request->product_id,
        ]);
        $user_id = $request->user_id;
        return redirect()->route('customer-orders', $user_id);

    }

}
