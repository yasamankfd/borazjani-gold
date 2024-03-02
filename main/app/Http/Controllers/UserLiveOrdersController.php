<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserLiveOrdersController extends Controller
{
    public function index()
    {
        $user_id = 1;
        $market = Setting::where("s_key","market_status")->value('s_value');
//        $orders = Orders::where('user_id' , $user_id)->orderBy('created_at', 'desc')->get();
        return view('user_live_orders',compact('market' ,'user_id'));
    }
    public function list_orders()
    {
        $user_id = 1;
        Log::debug("herereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee");
        $orders = Orders::where("user_id",$user_id)->orderBy('created_at', 'desc')->get();
        return datatables()->of($orders)
            ->addIndexColumn()
            ->setRowClass(function () {
                return
                    "flex flex-row justify-between items-center bg-slate-100 w-fit md:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70";            })
            ->addColumn('title', function ($row) {
//                Log::debug($row);
                return '<td>' . $row->product->title . '</td>';
            })
            ->addColumn('value', function ($row) {
                $unit = $row->unit == "gram" ? "گرم" : "تعداد" ;
                return '<td><span>'.$row->value.'</span><span class="text-gray-400 font-extralight">'.$unit.'</span></td>';
            })
            ->addColumn('fee', function ($row) {

                return '<td>' . $row->fee . '</td>';
            })
            ->addColumn('totalPrice', function ($row) {

                return '<td>' . $row->total_price . '</td>';
            })
            ->addColumn('type', function ($row) {
                $type =  $row->type == "sell" ? "فروش" : "خرید" ;
                $class = $row->type == "sell" ? "bg-colorthird1" : "bg-colorfourth1" ;
                return '<td>' . '<span class=" '.$class.' px-4 py-2 w-full text-white rounded-full flex max-w-fit">'.$type.'</span>' . '</td>';
            })
            ->addColumn('status', function ($row) {
                return '<td>' . '<label hidden="hidden">'.$row->status.'</label>
                <p id="countdown_'.$row->id.'"> <span id="countdownValue_'.$row->id.'" class="bg-colorsecondry2 px-4 py-2 w-full text-white rounded-full flex max-w-fit font-extrabold text-base">0</span> ثانیه </p>' . '</td>';
            })


            ->rawColumns(['title','value','fee','type','totalPrice','status'])
            ->make(true);
    }
    public function checkOrderTime($created)
    {
        return Carbon::parse($created)->diffInMinutes() < 2;
    }
}
