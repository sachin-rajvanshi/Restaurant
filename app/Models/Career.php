<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Career extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
    	'enquiry_id',
    	'name',
    	'email',
    	'mobile_number',
    	'dob',
    	'image',
    	'gender',
    	'country_id',
    	'state_id',
    	'city_id',
    	'address',
    	'post_id',
    	'cv',
    	'message'
    ];
}
