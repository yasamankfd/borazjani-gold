<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class RefreshData extends Controller
{
    public function getUpdatedData()
    {
        // Your logic to fetch updated data goes here
        $updatedData = Price::all();

        return response()->json($updatedData);
    }
}
