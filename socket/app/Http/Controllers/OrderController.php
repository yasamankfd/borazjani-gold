<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $market  =  Setting::where("s_key","market_status")->value('s_value');
        return view("order",compact('market','products'));
    }
}
