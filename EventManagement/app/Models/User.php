<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['email','firstName','lastName','mobile','password']; 

    protected $attributes = [

        'otp' => '0'

    ];

    public function events()
{
    return $this->hasMany(Event::class);
}
}
