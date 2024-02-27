<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Trades;
use Illuminate\Http\Request;

class AdminTransactionsController extends Controller
{
    public function index()
    {
        $market = Setting::where("s_key","market_status")->value('s_value');
        $transactions = Trades::orderBy('created_at', 'desc')->get();
        return view("admin_transaction", compact("market", "transactions"));
    }
}
