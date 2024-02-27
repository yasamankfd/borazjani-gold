<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Setting;

class UserLiveOrdersController extends Controller
{
    public function index($user_id)
    {
        $market = Setting::where("s_key","market_status")->value('s_value');
        $orders = Orders::where('user_id' , $user_id)->orderBy('created_at', 'desc')->get();
        return view('user_live_orders',compact('orders','market'));
    }
}
