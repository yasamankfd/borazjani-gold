<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name', 'password','username','lastname','nid','nid_serial','code','certificate_img','national_card_img','status','phone'
    ];

    public function getCardShowAttribute(){
        Log::debug("-------------------");
        Log::debug($this->card_img);
        return url()->asset("storage/".$this->national_card_img);
    }

    public function getLicenceShowAttribute(){
        Log::debug("-------------------");
        Log::debug($this->licence_img);
        return url()->asset("storage/".$this->certificate_img);
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
