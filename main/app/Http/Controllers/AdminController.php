<?php

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use App\Models\Orders;
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
        $orders = Orders::all();

        return view('dashboard_admin' , compact('products','market','orders'));
    }

    public function singleProductChange(Request $request)
    {
        Log::debug($request);
        $product_id = $request->product_id;
        $buy_price = $request->buy_price;
        $sell_price = $request->sell_price;
        $buy_status = $request->buy_status;
        $sell_status = $request->sell_status;
        $product = Products::find($product_id);

        $product->update([
            "buy_price" => $buy_price,
            "sell_price" => $sell_price,
            "buy_status" => $buy_status,
            "sell_status" => $sell_status,
        ]);
        event(new MessageNotification("market_price"));
        return redirect(route('dashboard_admin'));
    }

    public function productChange($product,$status,$type)
    {
        $market  =  Products::where("id",$product);

        if($type == "buy")
        {
            $market->update([
                "buy_status" => $status,
            ]);
        }else{
            $market  =  Products::where("id",$product);
            $market->update([
                "sell_status" => $status,
            ]);
        }
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
    public function baseInformation()
    {

        $products = Products::all();
        $market  =  Setting::where("s_key","market_status")->value('s_value');
        $orders = Orders::all();

        return view('base_information_admin' , compact('products','market','orders'));

    }

    public function create(Request $request)
    {
        Log::debug($request);

        $status = $request->modal_product_status;
        $status = $status == null ? 0 : 1 ;
        $unit = $request->modal_product_unit;
        $unit_enum = $unit == "گرم"  ? Products::UNIT_GRAM : Products::UNIT_NUMBER;

        $product = Products::updateOrCreate(
            ['id' => $request->modal_product_id],
            ["title" => $request->modal_product_title,
            "buy_price" => $request->modal_product_buy_price,
            "sell_price" => $request->modal_product_sell_price,
            "buy_status" => 0,
            "sell_status" => 0,
            "status" => $status,
            "unit" => $unit_enum ,]);
        event(new MessageNotification("market_price"));
        Log::debug($product);
        event(new MessageNotification("market_price"));
        return redirect(route('base-information'));
    }

    public function destroy()
    {

    }

    public function show()
    {

    }

    public function findProduct($product_id)
    {
        $product = Products::find($product_id);
        //Log::debug($user);
        return response()->json($product);
    }
//
//    public function update(Request $request)
//    {
//        Log::debug("change price for all");
//        $products = Products::all();
//        foreach ($products as $p)
//        {
//            $buy_name = $request->input('buy_price_'.$p->id);
//            $sell_name = $request->input('sell_price_'.$p->id);
//
//            $buy_price = isset($buy_name) ? $buy_name : $p->buy_price;
//            $sell_price = isset($sell_name) ? $sell_name : $p->sell_price;
//
//            $p->update([
//                "buy_price" => $buy_price,
//                "sell_price" => $sell_price,
//            ]);
//        }
//
//        event(new MessageNotification("market_price"));
//        return redirect(route("index"));
//    }
}
