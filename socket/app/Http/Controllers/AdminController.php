<?php

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use App\Models\Price;
use App\Models\Products;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $market  =  Setting::where("s_key","market_status")->value('s_value');
        return view('admin' , compact('products','market'));
    }

    public function store()
    {

    }

    public function productChange($product,$status)
    {
        $market  =  Products::where("id",$product);
        $market->update([
            "status" => $status,
        ]);
        event(new MessageNotification("market_price"));
    }
    public function marketChange($status)
    {
        Log::debug($status);

        $market  =  Setting::where("s_key","market_status");
        $market->update([
           "s_value" => $status,
        ]);
        event(new MessageNotification("market_status"));
    }

    public function create()
    {

    }

    public function destroy()
    {

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update(Request $request)
    {
        Log::debug($request);
//        dd($request);
//        $p = $product->buy_price;
//        $product = null;
//        $buy_prices = $request->buy_prices;
//        $sell_prices = $request->sell_prices;
        $products = Products::all();
        foreach ($products as $p)
        {
            $buy_name = $request->input('buy_price_'.$p->id);
            $sell_name = $request->input('sell_price_'.$p->id);

//            $buy_name = $request->buy_price_.$p->id;
//            $sell_name = $request->sell_price_.$p->id;
            Log::debug($buy_name);
            Log::debug($sell_name);
            $buy_price = isset($buy_name) ? $buy_name : $p->buy_price;
            $sell_price = isset($sell_name) ? $sell_name : $p->sell_price;

            $p->update([
                "buy_price" => $buy_price,
                "sell_price" => $sell_price,
            ]);
        }

        event(new MessageNotification("market_price"));
        return redirect(route("index"));
    }
}
