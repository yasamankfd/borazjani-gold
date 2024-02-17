<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'temp_order';
    public const TYPE_SELL = "sell";
    public const TYPE_BUY = "buy";

    protected $fillable=[
        "value","fee","total_price","status","type","user_id","product_id",
    ];

}
