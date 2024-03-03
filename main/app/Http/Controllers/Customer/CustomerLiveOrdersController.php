<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;

class CustomerLiveOrdersController extends Controller
{
    public function index()
    {
        $user_id = 1;
        $market = Setting::where("s_key","market_status")->value('s_value');
        return view('customer.customer_live_orders',compact('market' ,'user_id'));
    }
    public function list_orders()
    {
        $user_id = 1;
        Log::debug("herereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee");
        $orders = Orders::orderBy('created_at', 'desc')->where("user_id",$user_id)->get();
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
            ->addColumn('time', function ($row) {
                return '<td>' . $row->dateToJalali() . '</td>';
            })
            ->addColumn('status', function ($row) {
                if($this->checkOrderTime($row->created_at) )
                {
                    return '<td>' . '<label hidden="hidden">'.$row->status.'</label>
                <p id="countdown_'.$row->id.'"> <span id="countdownValue_'.$row->id.'" class="bg-colorsecondry2 px-4 py-2 w-full text-white rounded-full flex max-w-fit font-extrabold text-base">0</span> ثانیه </p>' . '</td>';
                } else {
                    if ($row->status == 2) {
                        return '<td>
                                    <label>ثبت شده</label>
                                </td>';
                    } else {
                        return '<td>
                                    <label>پایان یافته</label>
                                </td>';
                    }
                }
            })->rawColumns(['title','value','fee','type','totalPrice','status','time'])
            ->make(true);
    }
    public function checkOrderTime($created)
    {
        return Carbon::parse($created)->diffInMinutes() < 2;
    }
}
