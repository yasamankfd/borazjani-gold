<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trades extends Model
{
    use HasFactory;
    protected $table = 'trade';

    protected $fillable=[
        "amount","fee","total","time","number","type","user_id","product_id",
    ];

}
