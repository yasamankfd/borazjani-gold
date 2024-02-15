<?php

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use App\Models\Products;
use App\Models\Setting;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $market = Setting::where("s_key","market_status")->value('s_value');
        $products = Products::all();
        event(new MessageNotification("market_status"));
        return view('customer' , compact('products','market'));
    }
}
