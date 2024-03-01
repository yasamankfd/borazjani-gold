<?php

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use App\Models\Orders;
use App\Models\Price;
use App\Models\Products;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $market  =  Setting::where("s_key","market_status")->value('s_value');
        $orders = Orders::all();

        return view('dashboard_admin' , compact('products','market','orders'));
    }
    public function list_dashboard_products()
    {
        $products = Products::all();
        return datatables()->of($products)
            ->addIndexColumn()
            ->setRowClass(function () {
                return "flex flex-row justify-between items-center bg-slate-100 w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70";
            })
            ->addColumn('title', function ($row) {
                return '<td>' . $row->title. '</td>';
            })
            ->addColumn('buy_price', function ($row) {
                $unit = $row->unit == "gram" ? "گرم" : "تعداد" ;
                return '<td>
                            <input name="buy_price_'.$row->id.'" id="buy_price_'.$row->id.'" value="'.$row->buy_price.'" type="text" class="bg-transparent w-full rounded-full text-center border-colorfourth1 focus:outline-colorsecondry1 focus:ring-0 focus:border-0 text-sm">
                        </td>';
            })
            ->addColumn('sell_price', function ($row) {

                return '<td>
                            <input name="sell_price_'.$row->id.'" id="sell_price_'.$row->id.'" value="'.$row->sell_price.'" type="text" class="bg-transparent w-full rounded-full text-center border-colorthird1 focus:outline-colorsecondry1 focus:ring-0 focus:border-0 text-sm">
                        </td>';
            })
            ->addColumn('buy_status', function ($row) {
                $checkbox = $row->buy_status ==1 ? "checked" : "";
                $divClass = "relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1";
                return '<td>                <label class="flex gap-2 items-center cursor-pointer">
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-300">بسته</span>
                                                <input name="product_buy_status_'.$row->id.'" id="product_buy_status_'.$row->id.'" type="checkbox" '.$checkbox.' class="sr-only peer">
                                                <div class="'.$divClass.'"></div>
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-300">باز</span>
                                            </label>
                        </td>';
            })
            ->addColumn('sell_status', function ($row) {
                $checkbox = $row->sell_status ==1 ? "checked" : "";
                $divClass = "relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1";
                return '<td>                <label class="flex gap-2 items-center cursor-pointer">
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-300">بسته</span>
                                                <input name="product_sell_status_'.$row->id.'" id="product_sell_status_'.$row->id.'" type="checkbox" '.$checkbox.' class="sr-only peer">
                                                <div class="'.$divClass.'"></div>
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-300">باز</span>
                                            </label>
                        </td>';
            })
            ->addColumn('action', function ($row) {

                return '                <td>
                                            <form action="'.route("product-edit").'" id="edit_product" method="POST">
                                                ' . csrf_field() . '
                                            </form>
                                            <button onclick="open_edit_modal('.$row->id.')"  class="bg-colorprimary p-3 py-2 text-white rounded-full flex cursor-pointer hover:scale-105  transition-transform font-light text-xs">
                                                ویرایش
                                            </button>
                                            <button onclick="submit_form('.$row->id.' , 1 )"  class="bg-colorprimary p-3 py-2 text-white rounded-full flex cursor-pointer hover:scale-105  transition-transform font-light text-xs">
                                                ثبت
                                            </button>
                                        </td>';
            })
            ->rawColumns(['title','buy_price','sell_price','buy_status','sell_status','action'])
            ->make(true);
    }


    public function list_base_info_products()
    {
        $products = Products::all();
        return datatables()->of($products)
            ->addIndexColumn()
            ->setRowClass(function () {
                return "flex flex-row justify-between items-center bg-slate-100 w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70";
            })
            ->addColumn('title', function ($row) {
                return '<td>' . $row->title. '</td>';
            })
            ->addColumn('unit', function ($row) {
                $unit = $row->unit == "gram" ? "گرم" : "تعداد" ;
                return '<td>
                            <span class="font-normal tracking-tight">'.$unit.'</span>
                        </td>';
            })
            ->addColumn('buy_price', function ($row) {

                return '<td>'.$row->buy_price.'</td>';
            })
            ->addColumn('sell_price', function ($row) {
                return '<td>'.$row->sell_price.'</td>';
            })
            ->addColumn('status', function ($row) {
                $status = $row->status ==1 ? "فعال" : "غیرفعال";
                $class = $row->status ==1 ? "bg-colorfourth1":"bg-colorthird1";
                return '<td>
                             <span class="'.$class.' text-white px-3 py-1 rounded-full font-light">'.$status.'</span>
                        </td>';
            })
            ->addColumn('action', function ($row) {

                return '                <td>
                                            <button onclick="open_edit_modal('.$row->id.')"  class="bg-colorprimary p-2 rounded-xl">
                                               <img  src="'.url("/img/edit-icon.svg").'" alt="" class="w-4">
                                            </button>
                                        </td>';
            })
            ->rawColumns(['title','buy_price','sell_price','status','unit','action'])
            ->make(true);
    }



    public function showMarketChange()
    {
        $products = Products::all();
        $market  =  Setting::where("s_key","market_status")->value('s_value');
        $orders = Orders::all();

        return view('admin_market_change' , compact('products','market','orders'));
    }

    public function singleProductChange(Request $request)
    {
        Log::debug($request);
        $product_id = $request->product_id;
        $buy_price = $request->buy_price;
        $sell_price = $request->sell_price;
        $buy_status = $request->buy_status;
        $sell_status = $request->sell_status;
        $product = Products::find($product_id);

        $product->update([
            "buy_price" => $buy_price,
            "sell_price" => $sell_price,
            "buy_status" => $buy_status,
            "sell_status" => $sell_status,
        ]);
        event(new MessageNotification("market_price"));
        return redirect(route('dashboard_admin'));
    }

    public function productChange($product,$status,$type)
    {
        $market  =  Products::where("id",$product);

        if($type == "buy")
        {
            $market->update([
                "buy_status" => $status,
            ]);
        }else{
            $market  =  Products::where("id",$product);
            $market->update([
                "sell_status" => $status,
            ]);
        }
        event(new MessageNotification("market_price"));
    }
    public function marketChange($status)
    {
        Log::debug($status);

        $market  =  Setting::where("s_key","market_status");
        $market->update([
           "s_value" => $status,
        ]);
        event(new MessageNotification("market_status"));
    }
    public function baseInformation()
    {

        $products = Products::all();
        $market  =  Setting::where("s_key","market_status")->value('s_value');
        $orders = Orders::all();

        return view('base_information_admin' , compact('products','market','orders'));

    }

    public function create(Request $request)
    {
        Log::debug($request);

        $status = $request->modal_product_status;
        $status = $status == null ? 0 : 1 ;
        $unit = $request->modal_product_unit;
        $unit_enum = $unit == "گرم"  ? Products::UNIT_GRAM : Products::UNIT_NUMBER;

        $product = Products::updateOrCreate(
            ['id' => $request->modal_product_id],
            ["title" => $request->modal_product_title,
            "buy_price" => $request->modal_product_buy_price,
            "sell_price" => $request->modal_product_sell_price,
            "buy_status" => 0,
            "sell_status" => 0,
            "status" => $status,
            "unit" => $unit_enum ,]);
        event(new MessageNotification("market_price"));
        Log::debug($product);
        event(new MessageNotification("market_price"));
        return redirect(route('base-information'));
    }

    public function destroy()
    {

    }

    public function show()
    {

    }

    public function findProduct($product_id)
    {
        $product = Products::find($product_id);
        //Log::debug($user);
        return response()->json($product);
    }
//
//    public function update(Request $request)
//    {
//        Log::debug("change price for all");
//        $products = Products::all();
//        foreach ($products as $p)
//        {
//            $buy_name = $request->input('buy_price_'.$p->id);
//            $sell_name = $request->input('sell_price_'.$p->id);
//
//            $buy_price = isset($buy_name) ? $buy_name : $p->buy_price;
//            $sell_price = isset($sell_name) ? $sell_name : $p->sell_price;
//
//            $p->update([
//                "buy_price" => $buy_price,
//                "sell_price" => $sell_price,
//            ]);
//        }
//
//        event(new MessageNotification("market_price"));
//        return redirect(route("index"));
//    }
}
