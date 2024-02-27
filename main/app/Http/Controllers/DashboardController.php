<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $market = Setting::where("s_key","market_status")->value('s_value');
        $products = Products::all();
        return view('dashboard' , compact('products','market'));
    }
}
