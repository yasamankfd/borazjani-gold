<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Setting;
use App\Models\Trades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $market = Setting::where("s_key","market_status")->value('s_value');
        $products = Products::all();
        return view('dashboard' , compact('products','market'));
    }
    public function list_products()
    {
        $products = Products::where("status",'1')->get();
        Log::debug($products);
        return datatables()->of($products)
            ->addIndexColumn()
            ->setRowClass(function () {
                return "flex flex-row justify-between items-center bg-slate-100 w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative";            })
            ->addColumn('title', function ($row) {
                return '<td>' . $row->title. '</td>';
            })

            ->addColumn('buy_price', function ($row) {

                return '<td>'.$row->buy_price.'</td>';
            })
            ->addColumn('sell_price', function ($row) {
                return '<td>'.$row->sell_price.'</td>';
            })
            ->addColumn('action', function ($row) {
                $market = Setting::where("s_key","market_status")->value('s_value');

                Log::debug("buy");
                Log::debug($row->buy_status);
                Log::debug("sell");
                Log::debug($row->sell_status);
                $buy_disabled = $row->buy_status == 0 || $market == "closed" ? "disabled" : "";
                $sell_disabled = $row->sell_status == 0 || $market == "closed" ? "disabled" : "";
                $buy_func = "open_trade_page(".$row->id." , "."'buy'".")";
                $sell_func = "open_trade_page(".$row->id." , "."'sell'".")";;

                return '                <td>
                                             <button id="button_buy_price_'.$row->id.'" onclick="'.$buy_func.'" class="bg-colorfourth1 disable_btn px-5 py-2 w-full text-white rounded-full flex max-w-fit cursor-pointer hover:scale-105  transition-transform" '.$buy_disabled.' >
                                                خرید
                                             </button>
                                             <button id="button_sell_price_'.$row->id.'" onclick="'.$sell_func.'" class="bg-colorthird1 px-5 py-2 w-full text-white rounded-full flex max-w-fit cursor-pointer hover:scale-105 transition-transform" '.$sell_disabled.' >
                                                فروش
                                             </button>
                                        </td>';
            })
            ->rawColumns(['title','buy_price','sell_price','action'])
            ->make(true);
    }

}
