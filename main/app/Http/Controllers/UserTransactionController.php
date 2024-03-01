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
        return view("user_transaction", compact("market", "transactions","user_id"));
    }

    public function list_transactions_buy($user_id)
    {
        $orders = Trades::where('type', 'buy')->where("user_id",$user_id)->get();
        return datatables()->of($orders)
            ->addIndexColumn()
            ->setRowClass(function () {
                return
                    "flex flex-row justify-between items-center bg-slate-100 w-fit md:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70";            })
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
            ->rawColumns(['title','value','fee','type','totalPrice','time','number'])
            ->make(true);
    }

    public function list_transactions_sell($user_id)
    {
        $orders = Trades::where('type', 'sell')->where("user_id",$user_id)->get();
        return datatables()->of($orders)
            ->addIndexColumn()
            ->setRowClass(function () {
                return
                    "flex flex-row justify-between items-center bg-slate-100 w-fit md:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70";            })

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
            ->rawColumns(['title','value','fee','type','totalPrice','time','number'])
            ->make(true);
    }
}
