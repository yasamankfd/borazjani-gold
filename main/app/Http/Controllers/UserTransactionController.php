<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Setting;
use App\Models\Trades;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{
    public function index($user_id)
    {
        $market = Setting::where("s_key","market_status")->value('s_value');
        $transactions = Trades::where('user_id' , $user_id)->orderBy('created_at', 'desc')->get();
        return view("user_transaction", compact("market", "transactions"));
    }
}
