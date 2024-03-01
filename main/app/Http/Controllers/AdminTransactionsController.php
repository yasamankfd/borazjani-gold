<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use App\Models\Setting;
use App\Models\Trades;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminTransactionsController extends Controller
{
    public function index()
    {
        $market = Setting::where("s_key","market_status")->value('s_value');
        $transactions = Trades::orderBy('created_at', 'desc')->get();
        return view("admin_transaction", compact("market", "transactions"));
    }
    public function list_transactions_buy()
    {
        $orders = Trades::where('type', 'buy')->get();
        return datatables()->of($orders)
            ->addIndexColumn()
            ->setRowClass(function () {
                return "flex flex-row justify-between items-center bg-slate-100 w-fit xl:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70";
            })
            ->addColumn('user', function ($row) {
                return '<td>' . $row->id . '</td>';
            })
            ->addColumn('user', function ($row) {
                return '<td>' . $row->user->name ." ". $row->user->lastname . '</td>';
            })
            ->addColumn('title', function ($row) {
                return '<td>' . '<span>'.$row->product->title.'</span><span class="font-light"></span>' . '</td>';
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
            ->addColumn('time', function ($row) {
                return '               <td class="oneLine text-lengh w-36 xl:w-[20%] text-center font-normal tracking-tight text-sm flex gap-2 justify-center">
                                          <span class="w-full flex max-w-fit">
                                             '.$row->created_at.'
                                          </span>
                                          <span class="w-full flex max-w-fit">

                                         </span>
                                        </td>';
            })

            ->addColumn('number', function ($row) {

                return '<td>' . '<span class=" px-4 py-2 w-full text-black rounded-full flex max-w-fit">'.$row->number.'</span></td>';
            })
            ->rawColumns(['row','user','title','value','fee','type','totalPrice','time','number'])
            ->make(true);
    }

    public function list_transactions_sell()
    {
        $orders = Trades::where('type', 'sell')->get();
        return datatables()->of($orders)
            ->addIndexColumn()
            ->setRowClass(function () {
                return "flex flex-row justify-between items-center bg-slate-100 w-fit xl:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70";
            })
            ->addColumn('user', function ($row) {
                return '<td>' . $row->user->name ." ". $row->user->lastname . '</td>';
            })
            ->addColumn('title', function ($row) {
                return '<td>' . '<span>'.$row->product->title.'</span><span class="font-light"></span>' . '</td>';
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
            ->addColumn('time', function ($row) {
                return '               <td class="oneLine text-lengh w-36 xl:w-[20%] text-center font-normal tracking-tight text-sm flex gap-2 justify-center">
                                          <span class="w-full flex max-w-fit">
                                             '.$row->created_at.'
                                          </span>
                                          <span class="w-full flex max-w-fit">

                                         </span>
                                        </td>';
            })

            ->addColumn('number', function ($row) {

                return '<td>' . '<span class=" px-4 py-2 w-full text-black rounded-full flex max-w-fit">'.$row->number.'</span></td>';
            })
            ->rawColumns(['user','title','value','fee','type','totalPrice','time','number'])
            ->make(true);
    }

    public function getCreatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i:s');
    }

}
