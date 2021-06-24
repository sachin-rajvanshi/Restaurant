<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $fillable = [
    	'logo',
    	'favicon',
    	'title',
    	'description',
    	'keywords',
    	'phone_number',
    	'email', 
    	'facebook',
    	'twitter',
    	'youtube',
    	'linkedin',
    	'header_permission',
    	'email_permission',
    	'contact_permission',
    	'social_permission'
    ];
}
