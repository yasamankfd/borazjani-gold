<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Setting;
use App\Models\Trades;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminLiveOrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::orderBy('created_at', 'desc')->get();
        $market = Setting::where("s_key","market_status")->value('s_value');
        return view('admin_live_orders' , compact('orders','market'));
    }

    public function list_products()
    {
        $orders = Orders::orderBy('created_at', 'desc')->get();
        return datatables()->of($orders)
            ->addIndexColumn()
            ->setRowClass(function () {
                return "flex flex-row justify-between items-center bg-slate-100 w-fit xl:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70";
            })
            ->addColumn('user', function ($row) {
//                Log::debug($row);
                return '<td>' . $row->user->name ." ". $row->user->lastname . '</td>';
            })
            ->addColumn('title', function ($row) {
                return '<td>' . '<span>'.$row->product->title.'</span><span class="font-light">2321</span>' . '</td>';
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
            ->addColumn('status', function ($row) {
                return '<td>' . '<label hidden="hidden">'.$row->status.'</label>
                <p id="countdown_'.$row->id.'"> <span id="countdownValue_'.$row->id.'" class="bg-colorsecondry2 px-4 py-2 w-full text-white rounded-full flex max-w-fit font-extrabold text-base">0</span> ثانیه </p>' . '</td>';
            })

            ->addColumn('type', function ($row) {
                $type =  $row->type == "sell" ? "فروش" : "خرید" ;
                $class = $row->type == "sell" ? "bg-colorthird1" : "bg-colorfourth1" ;
                return '<td>' . '<span class=" '.$class.' px-4 py-2 w-full text-white rounded-full flex max-w-fit">'.$type.'</span>' . '</td>';
            })
            ->addColumn('action', function ($row) {
                $route = 'admin-save-order';
                $passedTime = Carbon::parse($row->created_at)->diffForHumans();
                Log::debug($passedTime);
//                $this.$this->checkOrderTime()

                if ($this->checkOrderTime($row->created_at)) {
                    return '<td>
                                <form method="POST" action="'.route($route).'">
                                                   ' . csrf_field() . '
                                                  <input id="order_id" name="order_id" value="'.$row->id.'" class="hidden">
                                                  <button type="submit"  class="bg-colorprimary px-5 py-2 w-full text-white rounded-full flex max-w-fit font-extrabold text-base cursor-pointer">
                                                تایید
                                                  </button>
                                </form>
                        </td>';
                } else {
                    return '<td>
                                <label>پایان یافته</label>
                        </td>';                }




            })
            ->rawColumns(['user','title','value','fee','type','totalPrice','action','status'])
            ->make(true);
    }
    public function checkOrderTime($created)
        {
            return Carbon::parse($created)->diffInMinutes() < 2;
        }
    function generate_number($length)
    {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);
    }
    public function orderSave(Request $request)
    {
        $order_id = $request->order_id;
        $order = Orders::find($order_id);
        $order->status = 2;
        $order->save();
        Log::debug($order);
        $number = $this->generate_number(5);
        while (Trades::where('number', $number)->exists())
        {
            $number = $this->generate_number(5);
        }
        Trades::create([
            "value" => $order->value,
            "fee" => $order->fee,
            "total_price" => $order->total_price,
            "number" => $number,
            "type" => $order->type,
            "user_id" => $order->user_id,
            "product_id" => $order->product_id
        ]);
        return redirect()->route('admin-liveorders', );
    }
}
