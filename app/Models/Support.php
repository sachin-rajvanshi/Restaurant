<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
    	'support_id',
    	'name',
    	'email',
    	'mobile_number',
    	'subject',
    	'message',
    	'status',
    ];
}
