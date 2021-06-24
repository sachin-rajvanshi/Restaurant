<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'otp',
    	'email',
    	'mobile_number',
    	'use_for'
    ];
}
