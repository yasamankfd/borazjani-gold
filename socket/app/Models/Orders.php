<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'temp_order';
    public const TYPE_SELL = "sell";
    public const TYPE_BUY = "buy";

    protected $fillable=[
        "value","fee","total_price","status","type","user_id","product_id",
    ];
    public function product() : HasOne
    {
        return $this->hasOne( Products::class ,'id','product_id');
    }

}
