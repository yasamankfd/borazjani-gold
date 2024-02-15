<?php

namespace App\Events;

use App\Models\Products;
use App\Models\Setting;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $market_status;
    public $type;

    public $products;


    public function __construct($type)
    {
        if($type=="market_price")
        {
            $products = response()->json(Products::select("id","buy_price","sell_price","status")->get());
            $this->products = $products;
        }else{
             $this->market_status = response()->json(Setting::where("s_key","market_status")->value("s_value"));
        }
        $this->type = $type;

//        Log::debug($products);
    }


    public function broadcastOn()
    {
        return new Channel('notification');
    }
}
