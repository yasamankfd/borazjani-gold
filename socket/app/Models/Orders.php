<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'market';

    protected $fillable=[
        "amount","fee","total","time","status","type","user_id","product_id",
    ];

}
