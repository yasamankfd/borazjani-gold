<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Orders;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class AdminManageCustomersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $market  =  Setting::where("s_key","market_status")->value('s_value');
        // Calculate the orders for 2 minutes ago

        $currentTime = Carbon::now();
        $twoMinutesAgo = $currentTime->subMinutes(2);
        $num_of_orders = Orders::where('created_at', '>=', $twoMinutesAgo)->where('status',0)->count();

        return view("admin.admin_manage_customers", compact("users" , "market",'num_of_orders'));
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

    public function displayImage($type,$file_name)
    {
        $path = Storage::disk('local')->exists('public/uploads/images'.'/'.$type.'/'.$file_name);
        Log::debug('public/uploads/images'.'/'.$type.'/'.$file_name);
        if($path) {
            $content = Storage::get('public/uploads/images'.'/'.$type.'/'.$file_name);
            $mime = Storage::mimeType('public/uploads/images'.'/'.$type.'/'.$file_name);
            $response = Response::make($content, 200);
            $response->header("Content-Type", $mime);
            return $response;
        } else
        {
            $content = Storage::get('public/images/default.jpg');
            $mime = Storage::mimeType('public/images/default.jpg');
            $response = Response::make($content, 200);
            $response->header("Content-Type", $mime);
            return $response;
        }
    }

    public function create(CustomerRequest $request)
    {
        Log::debug($request);

        $status = $request->modal_customer_status;
        $status = $status == null ? 0 : 1 ;

        $fileName_certificate = time()."certificate_img.".$request->modal_customer_certificate->extension();
        $licence_path = $request->modal_customer_certificate->storeAs("licence",$fileName_certificate,"public");

        $fileName_card = time()."card_img.".$request->modal_customer_national_card->extension();
        $card_path = $request->modal_customer_national_card->storeAs("card",$fileName_card,"public");

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
                'nid'=> $request->modal_customer_nid,
                'phone' => $request->modal_customer_phone,
                'nid_serial'=> $request->modal_customer_serial,
                'code'=> $request->modal_customer_code,
                'certificate_img'=> $licence_path,
                'national_card_img'=> $card_path,
                'status'=> $status,
                ]);
        Log::debug($user);

        return response()->json(['code'=>200], 200);    }

    public function marketChange($status)
    {
        Log::debug($status);

        $market  =  Setting::where("s_key","market_status");
        $market->update([
            "s_value" => $status,
        ]);
        event(new MessageNotification("market_status"));
    }
}
