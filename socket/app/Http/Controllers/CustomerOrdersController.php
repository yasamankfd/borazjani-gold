<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerOrdersController extends Controller
{
    public function index($user_id){
        $orders = Orders::where('user_id' , $user_id)->get();
        Log::debug($orders);
//        $p_title = Products::find()
        return view('customer_orders',compact('orders'));
    }
}
