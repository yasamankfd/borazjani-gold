<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public const UNIT_NUMBER = "number";
    public const UNIT_GRAM = "gram";

    protected $table = 'product';
    protected $fillable=[
        "title","buy_price","sell_price","buy_status","sell_status","unit","status",
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'product_id');
    }
}
