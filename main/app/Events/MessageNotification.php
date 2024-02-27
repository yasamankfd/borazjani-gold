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
            Log::debug("message notif price or stat");
            $this->market_status = response()->json(Setting::where("s_key","market_status")->value("s_value"));
            $products = response()->json(Products::select("id","buy_price","sell_price","buy_status","sell_status")->get());
            $this->products = $products;
        }else{
            $products = response()->json(Products::select("id","buy_price","sell_price","buy_status","sell_status")->get());
            $this->products = $products;
            Log::debug("message notif market");
            $this->market_status = response()->json(Setting::where("s_key","market_status")->value("s_value"));
        }
        $this->type = $type;
    }


    public function broadcastOn()
    {
        return new Channel('notification');
    }
}
