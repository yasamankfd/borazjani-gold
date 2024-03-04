<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerEditRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerProfileController extends Controller
{
    public function index()
    {
        $user_id = 2;
        $market = Setting::where("s_key","market_status")->value('s_value');
        $user = User::find($user_id);
        return view("customer.customer_profile" ,compact("market" , "user"));
    }
    public function create(CustomerEditRequest $request)
    {
        Log::debug($request);


        $card_ext = $request->card->extension();
        $licence_ext = $request->licence->extension();
        $fileName_certificate = time()."certificate_img.".$licence_ext;
        $licence_path = $request->licence->storeAs("licence",$fileName_certificate,"public");

        $fileName_card = time()."card_img.".$card_ext;
        $card_path = $request->card->storeAs("card",$fileName_card,"public");

        if($request->password != null)
        {
            $pass = $request->password;
            $hashed = Hash::make($pass);
            if (Hash::check($pass, $hashed)) {
                $password = $hashed;
            }

            $user = User::update(
                ['id' => $request->customer_id],
                [   'name'=> $request->name,
                    'password'=> $password,
                    'username'=> $request->username,
                    'lastname'=> $request->lastname,
                    'nid'=> $request->nid,
                    'phone' => $request->phone,
                    'nid_serial'=> $request->idserial,
                    'code'=> $request->code,
                    'certificate_img'=> $licence_path,
                    'national_card_img'=> $card_path,
                ]);
        }else{
            $user = User::update(
                ['id' => $request->customer_id],
                [   'name'=> $request->name,
                    'username'=> $request->username,
                    'lastname'=> $request->lastname,
                    'nid'=> $request->nid,
                    'phone' => $request->phone,
                    'nid_serial'=> $request->idserial,
                    'code'=> $request->code,
                    'certificate_img'=> $licence_path,
                    'national_card_img'=> $card_path,
                ]);
        }

        Log::debug($user);
        return response()->json(['code'=>200], 200);
    }
}
