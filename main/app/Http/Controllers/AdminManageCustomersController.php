<?php

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use App\Models\Products;
use App\Models\Setting;
use App\Models\Trades;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminManageCustomersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $market  =  Setting::where("s_key","market_status")->value('s_value');

        return view("admin_manage_customers", compact("users" , "market"));
    }
    public function list_customers()
    {
        $users = User::all();
        return datatables()->of($users)
            ->addIndexColumn()
            ->setRowClass(function () {
                return "flex flex-row justify-between items-center bg-slate-100 w-fit md:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70";
            })
            ->addColumn('user', function ($row) {
                return '<td>' . $row->name ." ". $row->lastname . '</td>';
            })
            ->addColumn('phone', function ($row) {
                return '<td>' . $row->phone. '</td>';
            })
            ->addColumn('status', function ($row) {
                $status = $row->status ==1 ? 'فعال' : 'غیرفعال';
                $color = $row->status ==1 ? 'bg-colorfourth1' : 'bg-colorthird1';
                return '<td>' . '
                            <span class="'.$color.' text-white px-3 py-1 rounded-full font-light">'.$status.'</span>' .
                       '</td>';
            })
            ->addColumn('action', function ($row) {

                return '<td>' .'
                            <button onclick="open_edit_modal('.$row->id.')" class="bg-colorprimary p-2 rounded-xl">
                                <img src="'.url("/img/edit-icon.svg").'" alt="" class="w-4">
                            </button>'.
                    '</td>';
            })

            ->rawColumns(['user','phone','status','action'])
            ->make(true);
    }
    public function findCustomer($customer_id)
    {
        $user = User::find($customer_id);
        //Log::debug($user);
        return response()->json($user);
    }

    public function create(Request $request)
    {
        Log::debug($request);

        $status = $request->modal_customer_status;
        $status = $status == null ? 0 : 1 ;

        $fileName_certificate = time()."certificate_img.".$request->modal_customer_certificate->extension();
        $certificate_path = $request->modal_customer_certificate->storeAs("images",$fileName_certificate,"public");

        $fileName_card = time()."card_img.".$request->modal_customer_national_card->extension();
        $card_path = $request->modal_customer_national_card->storeAs("images",$fileName_card,"public");

        $pass = $request->modal_customer_pass;
        $hashed = Hash::make($pass);
        if (Hash::check($pass, $hashed)) {
            $password = $hashed;
        }

        $user = User::updateOrCreate(
            ['id' => $request->modal_customer_id],
            [   'name'=> $request->modal_customer_name,
                'password'=> $password,
                'username'=> $request->modal_customer_username,
                'lastname'=> $request->modal_customer_lname,
                'nid'=> $request->modal_customer_serial,
                'phone' => $request->modal_customer_phone,
                'nid_serial'=> $request->modal_customer_serial,
                'code'=> $request->modal_customer_code,
                'certificate_img'=> $certificate_path,
                'national_card_img'=> $card_path,
                'status'=> $status,
                ]);
        Log::debug($user);

        return redirect(route('admin-manage-customers'));
    }
}
