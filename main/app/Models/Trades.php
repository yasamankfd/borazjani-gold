<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trades extends Model
{
    use HasFactory;
    protected $table = 'order';
    public const TYPE_SELL = "sell";
    public const TYPE_BUY = "buy";

    protected $fillable=[
        "value","fee","total_price","number","type","user_id","product_id",
    ];
    public function product() : HasOne
    {
        return $this->hasOne( Products::class ,'id','product_id');
    }
    public function user() : HasOne
    {
        return $this->hasOne( User::class ,'id','user_id');
    }


}
