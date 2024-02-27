<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class AdminManageUsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $market  =  Setting::where("s_key","market_status")->value('s_value');

        return view("admin_manage_users", compact("users" , "market"));
    }
}
